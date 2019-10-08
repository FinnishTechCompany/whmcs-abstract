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

namespace IronLions\WHMCS\App\Service;

use IronLions\WHMCS\Domain\Core\Route;
use IronLions\WHMCS\Domain\Exception\Http\NamedRouteNotConfiguredException;
use IronLions\WHMCS\Domain\Exception\Http\RouteNotFoundException;

final class Router
{
    /**
     * @var Route[]
     */
    private static $routes = [];

    /**
     * @param Route $route
     */
    public static function add(Route $route): void
    {
        self::$routes[$route->getName()] = $route;
    }

    /**
     * @param string $path
     * @param string $method
     * @param bool   $admin
     *
     * @throws RouteNotFoundException
     *
     * @return Route
     */
    public static function get(string $path, string $method, bool $admin): Route
    {
        foreach (self::$routes as $route) {
            if ($route->isAdminArea() === $admin
            && $path === $route->getPath()
            && $route->isAllowed($method)) {
                return $route;
            }
        }

        throw new RouteNotFoundException('Page not found!');
    }

    /**
     * @param string $name
     *
     * @return Route
     */
    public static function getByName(string $name): Route
    {
        if (isset(self::$routes[$name])) {
            return self::$routes[$name];
        }

        throw new NamedRouteNotConfiguredException('Cannot find route');
    }
}
