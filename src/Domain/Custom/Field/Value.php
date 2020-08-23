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

namespace IronLions\WHMCS\Domain\Custom\Field;

use DateTimeImmutable;

final class Value
{
    public const TABLE = 'tblcustomfieldsvalues';
    public const FIELD_ID = 'id';
    public const FIELD_FIELD_ID = 'fieldid';
    public const FIELD_REL_ID = 'relid';
    public const FIELD_VALUE = 'value';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    private int $id;
    public int $fieldId;
    public int $relId;
    public string $value;
    public DateTimeImmutable $created_at;
    public DateTimeImmutable $updated_at;

    public function __construct(
        int $id,
        int $fieldId,
        int $relId,
        string $value,
        DateTimeImmutable $created_at,
        DateTimeImmutable $updated_at
    ) {
        $this->id = $id;
        $this->fieldId = $fieldId;
        $this->relId = $relId;
        $this->value = $value;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
