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

namespace IronLions\WHMCS\Domain\Core;

final class Variables
{
    /**
     * @var string
     */
    private $module;
    /**
     * @var string
     */
    private $modulelink;
    /**
     * @var string
     */
    private $version;
    /**
     * @var string
     */
    private $access;

    public function __construct(string $module, string $modulelink, string $version, string $access)
    {
        $this->module = $module;
        $this->modulelink = $modulelink;
        $this->version = $version;
        $this->access = $access;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getModulelink(): string
    {
        return $this->modulelink;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getAccess(): string
    {
        return $this->access;
    }
}
