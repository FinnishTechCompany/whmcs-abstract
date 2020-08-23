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
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\FileCacheReader;
use Symfony\Bundle\FrameworkBundle\Routing\AnnotatedRouteControllerLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Routing\Loader\AnnotationDirectoryLoader;
use Symfony\Component\Routing\Loader\AnnotationFileLoader;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\Loader\DirectoryLoader;
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


    private function setRequest(): void
    {
        $req = Request::createFromGlobals();
        $uri = parse_url($req->getUri());
        $uri['path'] = str_replace('.php', '', trim($uri['path'], '/'));

        $query = $req->query->all();
        if(isset($query['action'])) {
            $uri['path'] .= '/'.$req->query->get('action');
            unset($query['action']);
        }
        $uri['query'] = $query;

        var_dump(\http_build_url($uri));
        die;
        $this->request = Request::create(

        );
    }

    public function __construct()
    {
        self::$cb->isCompiled() ?: self::$cb->compile();
        $this->bus = new MessageBus($this->busMiddlewares());
        $this->setRequest();
        $matcher = new UrlMatcher(self::$routes, new RequestContext());
        $this->dispatcher = new EventDispatcher();
        $this->dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

        var_dump($this->request);
        die;
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
        return $this->bus->dispatch($command, $stamps);
    }

    public function handle(): Response
    {
        $this->response = $this->kernel->handle($this->request, HttpKernelInterface::SUB_REQUEST, false);

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
                $handlers[substr($handler, 0, -7).'Command'][] = self::$cb->get($handler);
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
        $resolver = new LoaderResolver([
            new AnnotationDirectoryLoader($locator, new AnnotatedRouteControllerLoader(new AnnotationReader())),
        ]);
        $loader->setResolver($resolver);

        return $loader;
    }
}
