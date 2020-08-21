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

final class Variables
{
    private string $module;
    private string $modulelink;
    private string $version;
    private string $access;

    public function __construct(string $module, string $modulelink, string $version, string $access)
    {
        $this->module = $module;
        $this->modulelink = $modulelink;
        $this->version = $version;
        $this->access = $access;
    }

    public function getModule(): string
    {
        return $this->module;
    }

    public function getModulelink(): string
    {
        return $this->modulelink;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getAccess(): string
    {
        return $this->access;
    }
}
