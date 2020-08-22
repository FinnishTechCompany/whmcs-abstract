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

final class Configuration
{
    public const TABLE = 'tblconfiguration';
    public const FIELD_ID = 'id';
    public const FIELD_SETTING = 'setting';
    public const FIELD_VALUE = 'value';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    private int $id;
    public string $setting;
    public string $value;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;

    public function __construct(
        int $id,
        string $setting,
        string $value,
        \DateTimeImmutable $createdAt,
        \DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->setting = $setting;
        $this->value = $value;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
