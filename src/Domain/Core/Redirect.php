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

namespace IronLions\WHMCS\Domain\Core;

use IronLions\WHMCS\App\Service\Router;

final class Redirect extends Response
{
    /** @noinspection MagicMethodsValidityInspection */

    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct(string $name, Variables $variables)
    {
        $route = $variables->getModulelink().'&action='.Router::getByName($name)->getPath();
        $admin = $GLOBALS['whmcs']->getApplicationConfig()->getData()['customadminpath'] ?? 'admin';
        $protocol = 0 === stripos($_SERVER['SERVER_PROTOCOL'], 'https') ? 'https://' : 'http://';
        header("Location: ${protocol}$_SERVER[HTTP_HOST]/$admin/$route");
        die();
    }
}
