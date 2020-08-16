<?php


namespace IronLions\WHMCS\Infra;


use League\Container\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
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

final class Kernel
{
    /** @var Request */
    private $request;
    /** @var Response */
    private $response;
    /** @var ControllerResolverInterface */
    private $controllerResolver;
    /** @var HttpKernelInterface */
    private $kernel;
    /** @var EventDispatcherInterface */
    private $dispatcher;
    /** @var ArgumentResolverInterface */
    private $argumentResolver;
    /** @var MessageBusInterface */
    private $bus;

    private $terminated = false;

    /** @var ContainerBuilder */
    private static $cb;

    /** @var array */
    private static $busConfig = [];

    public static function init(): void {
        self::$cb = new ContainerBuilder();
    }

    public static function __cb(): ContainerBuilder {
        return self::$cb;
    }

    public static function addCommands(array $bus)
    {
        self::$busConfig = array_merge($bus, self::$busConfig);
    }

    public function __construct() {
        self::$cb->compile();
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
     * @return Envelope
     */
    public function bus($command, array $stamps = []): Envelope
    {
        return $this->bus->dispatch($command, $stamps);
    }

    public function handle(): Response {
        $this->response = $this->kernel->handle($this->request, HttpKernelInterface::SUB_REQUEST, false);

        return $this->response;
    }

    public function terminate(): void {
        $this->kernel->terminate($this->request, $this->response);
        $this->terminated = true;
    }

    public function __destruct() {
        if ($this->terminated === false) {
            $this->kernel->terminate($this->request, $this->response);
        }
    }

    private function busMiddlewares(): array
    {

        var_dump(self::$busConfig);
        die;
        return [
            new HandleMessageMiddleware(
                new HandlersLocator([

                ]),
                false
            )
        ];
    }
}
