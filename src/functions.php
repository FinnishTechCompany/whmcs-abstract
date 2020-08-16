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

if (!function_exists('add_hook')) {
    function add_hook(string $hookName, int $priority, callable $callback): void
    {
    }
}

if (!function_exists('addEventSubscriber')) {
    /**
     * @param string $class Must be class implementing IronLions\WHMCS\App\Service\AbstractEventSubscriber
     */
    function addEventSubscriber(string $class): void
    {
        foreach ($class::subscribe() as $event => $callable) {
            add_hook($event, 1, $callable);
        }
    }
}
