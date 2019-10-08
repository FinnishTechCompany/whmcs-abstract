<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Domain\Core;

final class Request
{
    /**
     * @var array
     */
    private $vars;

    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return isset($_REQUEST['action']) ? $_REQUEST['action'] : '/';
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @param string|null $name
     *
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
