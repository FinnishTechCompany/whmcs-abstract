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

final class Request
{
    private array $vars;

    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    public function getPath(): string
    {
        return isset($_REQUEST['action']) ? $_REQUEST['action'] : '/';
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @return mixed
     */
    public function get(?string $name = null)
    {
        if (null === $name) {
            return $_POST;
        }

        return $_POST[$name] ?? null;
    }
}
