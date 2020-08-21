<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\App\Service;

use IronLions\WHMCS\Domain\Core\Route;
use IronLions\WHMCS\Domain\Exception\Http\NamedRouteNotConfiguredException;
use IronLions\WHMCS\Domain\Exception\Http\RouteNotFoundException;

final class Router
{
    private static array $routes = [];

    public static function add(Route $route): void
    {
        self::$routes[$route->getName()] = $route;
    }

    /**
     * @throws RouteNotFoundException
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

    public static function getByName(string $name): Route
    {
        if (isset(self::$routes[$name])) {
            return self::$routes[$name];
        }

        throw new NamedRouteNotConfiguredException('Cannot find route');
    }
}
