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

namespace IronLions\WHMCS\Domain\Custom;

use DateTimeImmutable;

final class Field
{
    public const TABLE = 'tblcustomfields';
    public const FIELD_ID = 'id';
    public const FIELD_TYPE = 'type';
    public const FIELD_REL_ID = 'relid';
    public const FIELD_FIELD_NAME = 'fieldname';
    public const FIELD_FIELD_TYPE = 'fieldtype';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_FIELD_OPTIONS = 'fieldoptions';
    public const FIELD_REG_EXPR = 'regexpr';
    public const FIELD_ADMIN_ONLY = 'adminonly';
    public const FIELD_REQUIRED = 'required';
    public const FIELD_SHOW_ORDER = 'showorder';
    public const FIELD_SHOW_INVOICE = 'showinvoice';
    public const FIELD_SORT_ORDER = 'sortorder';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    private int $id;
    public string $type;
    public int $relId;
    public string $fieldName;
    public string $fieldType;
    public string $description;
    public string $fieldOptions;
    public string $regExpr;
    public string $adminOnly;
    public string $required;
    public string $showOrder;
    public string $showInvoice;
    public int $sortOrder;
    public DateTimeImmutable $createdAt;
    public DateTimeImmutable $updatedAt;

    public function __construct(
        int $id,
        string $type,
        int $relId,
        string $fieldName,
        string $fieldType,
        string $description,
        string $fieldOptions,
        string $regExpr,
        string $adminOnly,
        string $required,
        string $showOrder,
        string $showInvoice,
        int $sortOrder,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->relId = $relId;
        $this->fieldName = $fieldName;
        $this->fieldType = $fieldType;
        $this->description = $description;
        $this->fieldOptions = $fieldOptions;
        $this->regExpr = $regExpr;
        $this->adminOnly = $adminOnly;
        $this->required = $required;
        $this->showOrder = $showOrder;
        $this->showInvoice = $showInvoice;
        $this->sortOrder = $sortOrder;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
