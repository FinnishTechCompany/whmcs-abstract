<?php

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Infra;

use Doctrine\Common\Annotations\AnnotationReader;
use IronLions\WHMCS\App\Service\CommandBusProxy;
use Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Routing\Loader\AnnotationDirectoryLoader;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

final class Kernel
{
    private Request $request;
    private Response $response;
    private HttpKernelInterface $kernel;
    private EventDispatcherInterface $dispatcher;
    private MessageBusInterface $bus;

    private static ContainerBuilder $cb;
    private static RouteCollection $routes;

    public function __construct()
    {
        $this->registerBus();
        self::$cb->isCompiled() ?: self::$cb->compile();
        $this->setRequest();
        $matcher = new UrlMatcher(self::$routes, new RequestContext());
        $this->dispatcher = new EventDispatcher();
        $this->dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        $this->kernel = new HttpKernel(
            $this->dispatcher,
            new ControllerResolver(),
            new RequestStack(),
            new ArgumentResolver()
        );
    }

    /**
     * @param $command Envelope|object
     * @param StampInterface[] $stamps
     */
    public function bus($command, array $stamps = []): Envelope
    {
        return self::$cb->get('app.command_bus')->dispatch($command, $stamps);
    }

    public function handle(): Response
    {
        try {
            $this->response = $this->kernel->handle($this->request, HttpKernelInterface::SUB_REQUEST, false);
        } catch (NotFoundHttpException $e) {
            if (\defined('FITECO_API')) {
                $this->response = new JsonResponse(['error' => 'Not found'], 404);
            } else {
                throw $e;
            }
        }

        return $this->response;
    }

    public function terminate(): void
    {
        $this->kernel->terminate($this->request, $this->response);
    }

    private function busMiddlewares(): array
    {
        $handlers = [];
        foreach (self::$cb->findTaggedServiceIds('app.bus') as $handler => $data) {
            if (empty($data[0])) {
                // Use default handler.
                if ('Handler' === !substr($handler, -7)) {
                    throw new \LogicException('Handler naming is invalid for automatic mapping. Please specify command manually.');
                }

                //$handlers[substr($handler, 0, -7).'Command'][] = self::$cb->get($handler);
                $handlers[substr($handler, 0, -7).'Command'][] =
                    function (...$args) use ($handler) { return self::$cb->get($handler)(...$args); };
            } else {
                // Override handlers.
                foreach ($data[0] as $command) {
                    $handlers[$command][] = self::$cb->get($handler);
                }
            }
        }

        return [
            new HandleMessageMiddleware(new HandlersLocator($handlers)),
        ];
    }

    private function registerBus(): void
    {
        if (self::$cb->isCompiled()) {
            $this->bus = self::$cb->get('app.command_bus');

            return;
        }

        $this->bus = new MessageBus($this->busMiddlewares());
        self::$cb->setDefinition(
            'app.command_bus',
            (new Definition())
                ->setPublic(true)
                ->setAutowired(true)
                ->setAutoconfigured(true)
                ->setArgument(0, $this->bus)
                ->setClass(CommandBusProxy::class)
        );
    }

    private function setRequest(): void
    {
        global $customadminpath;
        $req = Request::createFromGlobals();
        $uri = parse_url($req->getUri());
        $admin = 1 === preg_match("/^\/${customadminpath}\//i", $uri['path']);
        $query = $req->query->all();

        if (\defined('FITECO_API') && !$admin) {
            $this->setApiRequest($req, $uri);

            return;
        }

        if ($admin) {
            if (isset($query['module'])) {
                $uri['path'] = str_replace('/addonmodules', '', $uri['path']);
            }
            $uri['path'] = '__admin__'.preg_replace("/^\/${customadminpath}/i", '', $uri['path']);
        }

        $uri['path'] = str_replace(
            ['index.php', '.php'],
            ['', ''],
            trim($uri['path'], '/')
        );

        if (isset($query['action'])) {
            $uri['path'] .= '/'.$req->query->get('action');
            unset($query['action']);
        }

        if (isset($query['modop']) && 'custom' === strtolower($query['modop'])) {
            if (isset($query['a'])) {
                $uri['path'] .= '/'.$req->query->get('a');
                unset($query['a']);
            }
            unset($query['modop']);
        }

        if (isset($query['m'])) {
            $uri['path'] .= '/'.$req->query->get('m');
            unset($query['m']);
        }

        if (isset($query['m'])) {
            $uri['path'] .= '/'.$req->query->get('m');
            unset($query['m']);
        }

        if (isset($query['module'])) {
            $uri['path'] .= '/'.$req->query->get('module');
            unset($query['module']);
        }

        $uri['query'] = http_build_query($query);

        $this->request = Request::create(
            http_build_url($uri),
            $req->getRealMethod(),
            'GET' === $req->getMethod() ? $query : $req->request->all(),
            $req->cookies->all(),
            $req->files->all(),
            $req->server->all(),
            $req->getContent()
        );
    }

    private function setApiRequest(Request $req, array $uri): void
    {
        $uri['path'] = 'api'.str_replace(FITECO_API, '', trim($uri['path'], '/'));

        $this->request = Request::create(
            http_build_url($uri),
            $req->getRealMethod(),
            $req->request->all(),
            $req->cookies->all(),
            $req->files->all(),
            $req->server->all(),
            $req->getContent()
        );
    }

    /**
     * These functions are used before kernel is construct.
     */
    public static function init(): void
    {
        self::$cb = new ContainerBuilder();
        self::$routes = new RouteCollection();
    }

    public static function __cb(): ContainerBuilder
    {
        return self::$cb;
    }

    public static function __rt(): RoutingConfigurator
    {
        return new RoutingConfigurator(self::$routes, self::getLoader(), '', '');
    }

    private static function getLoader(): PhpFileLoader
    {
        $locator = new FileLocator();
        $loader = new PhpFileLoader($locator);
        $reader = new AnnotationReader();
        $reader->addGlobalIgnoredName('required');
        $resolver = new LoaderResolver([
            new AnnotationDirectoryLoader($locator, new AnnotatedRouteControllerLoader($reader)),
        ]);
        $loader->setResolver($resolver);

        return $loader;
    }
}
