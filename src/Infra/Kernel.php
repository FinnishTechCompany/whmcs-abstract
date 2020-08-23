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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\StampInterface;

final class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    private Request $request;
    private Response $response;
    private ControllerResolverInterface $controllerResolver;
    private HttpKernelInterface $kernel;
    private EventDispatcherInterface $dispatcher;
    private ArgumentResolverInterface $argumentResolver;
    private MessageBusInterface $bus;
    //private bool $terminated = false;

    private static ContainerBuilder $cb;
    private static array $busConfig = [];

    public function __construct()
    {
        self::$cb->isCompiled() ?: self::$cb->compile();
        $this->argumentResolver = new ArgumentResolver();
        $this->bus = new MessageBus($this->busMiddlewares());
        $this->request = Request::createFromGlobals();
        $this->dispatcher = new EventDispatcher();
        $this->controllerResolver = new ControllerResolver();
        $this->kernel = new HttpKernel(
            $this->dispatcher,
            $this->controllerResolver,
            new RequestStack(),
            $this->argumentResolver
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
        //$this->terminated = true;
    }

    /**
     * public function __destruct() {
     * if ($this->terminated === false) {
     * if ($this->response === null) {
     * $this->handle();
     * }
     * $this->kernel->terminate($this->request, $this->response);
     * }
     * } */
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

    public static function init(): void
    {
        self::$cb = new ContainerBuilder();
    }

    public static function __cb(): ContainerBuilder
    {
        return self::$cb;
    }
}
