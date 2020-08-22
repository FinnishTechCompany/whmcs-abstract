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

namespace IronLions\WHMCS\Domain\Product\Config\Option;

final class Sub
{
    public const TABLE = 'tblproductconfigoptionssub';
    public const FIELD_ID = 'id';
    public const FIELD_CONFIG_ID = 'configid';
    public const FIELD_OPTION_NAME = 'optionname';
    public const FIELD_SORT_ORDER = 'sortorder';
    public const FIELD_HIDDEN = 'hidden';

    private int $id;
    public int $configId;
    public string $optionName;
    public int $sortOrder;
    public bool $hidden;

    public function __construct(
        int $id,
        int $configId,
        string $optionName,
        int $sortOrder,
        bool $hidden
    ) {
        $this->id = $id;
        $this->configId = $configId;
        $this->optionName = $optionName;
        $this->sortOrder = $sortOrder;
        $this->hidden = $hidden;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
