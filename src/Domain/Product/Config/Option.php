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

namespace IronLions\WHMCS\Domain\Product\Config;

final class Option
{
    public const TABLE = 'tblproductconfigoptions';
    public const FIELD_ID = 'id';
    public const FIELD_GROUP_ID = 'gid';
    public const FIELD_OPTION_NAME = 'optionname';
    public const FIELD_OPTION_TYPE = 'optiontype';
    public const FIELD_QTY_MINIMUM = 'qtyminimum';
    public const FIELD_QTY_MAXIMUM = 'qtymaximum';
    public const FIELD_ORDER = 'order';
    public const FIELD_HIDDEN = 'hidden';

    private int $id;
    public int $groupId;
    public string $optionName;
    public string $optionType;
    public int $qtyMinimum;
    public int $qtyMaximum;
    public int $order;
    public bool $hidden;

    public function __construct(
        int $id,
        int $groupId,
        string $optionName,
        string $optionType,
        int $qtyMinimum,
        int $qtyMaximum,
        int $order,
        bool $hidden
    ) {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->optionName = $optionName;
        $this->optionType = $optionType;
        $this->qtyMinimum = $qtyMinimum;
        $this->qtyMaximum = $qtyMaximum;
        $this->order = $order;
        $this->hidden = $hidden;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
