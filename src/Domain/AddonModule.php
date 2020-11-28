<?php

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Domain;

final class AddonModule
{
    public const TABLE = 'tbladdonmodules';
    public const FIELD_ID = 'id';
    public const FIELD_MODULE = 'module';
    public const FIELD_SETTING = 'setting';
    public const FIELD_VALUE = 'value';

    private int $id;
    public string $module;
    public string $setting;
    public string $value;

    public function __construct(
        int $id,
        string $module,
        string $setting,
        string $value
    ) {
        $this->id = $id;
        $this->module = $module;
        $this->setting = $setting;
        $this->value = $value;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
