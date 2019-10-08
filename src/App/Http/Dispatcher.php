<?php

declare(strict_types=1);

/**
 *
 * WHMCS Gateway Fees 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\App\Http;

use IronLions\WHMCS\App\Service\Router;
use IronLions\WHMCS\Domain\Core\Request;
use IronLions\WHMCS\Domain\Core\Response;
use IronLions\WHMCS\Domain\Exception\Http\RouteNotFoundException;

final class Dispatcher
{
    public static $vars = [];
    public const TYPE_ADMIN = 0x1;
    public const TYPE_CLIENT = 0x2;
    /**
     * @var int
     */
    private $type;

    public function __construct(int $type = self::TYPE_ADMIN)
    {
        $this->type = $type;
    }

    public function dispatch(Request $request): string
    {
        self::$vars = $request->getVars();

        try {
            $route = Router::get($request->getPath(), $request->getMethod(), self::TYPE_ADMIN === $this->type);
        } catch (RouteNotFoundException $e) {
            return 'Error: '.$e->getMessage();
        }

        $controller = $route->getController();
        $controller = new $controller($request);
        $response = $controller->{$route->getAction()}();

        if ($response instanceof Response) {
            return (string) $response;
        }

        return 'Error: Return must be object of Response.';
    }

    /**
     * @param array $vars
     * @param int   $type
     *
     * @return string
     */
    public static function doDispatch(array $vars, int $type): string
    {
        try {
            $res = (new self($type))->dispatch(new Request($vars));
        } catch (\Exception | \LogicException $e) {
            return 'Error: <b>'.$e->getMessage().'</b> on '.$e->getFile().' at line '.$e->getLine();
        }

        return $res;
    }
}
