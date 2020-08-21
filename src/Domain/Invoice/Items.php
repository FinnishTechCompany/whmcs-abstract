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

namespace IronLions\WHMCS\Domain\Invoice;

final class Items
{
    public const TABLE = 'tblinvoiceitems';
    public const FIELD_ID = 'id';
    public const FIELD_INVOICE_ID = 'invoiceid';
    public const FIELD_USER_ID = 'userid';
    public const FIELD_TYPE = 'type';
    public const FIELD_REL_ID = 'relid';
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_AMOUNT = 'amount';
    public const FIELD_TAXED = 'taxed';
    public const FIELD_DUE_DATE = 'duedate';
    public const FIELD_PAYMENT_METHOD = 'paymentmethod';
    public const FIELD_NOTES = 'notes';

    private ?int $id;
    public int $invoiceId;
    public int $userId;
    public string $type;
    public int $relId;
    public string $description;
    public float $amount;
    public bool $taxed;
    public ?\DateTimeImmutable $dueDate;
    public ?string $paymentMethod;
    public string $notes;

    public function __construct(
        ?int $id,
        int $invoiceId,
        int $userId,
        string $type,
        int $relId,
        string $description,
        float $amount,
        bool $taxed,
        ?\DateTimeImmutable $dueDate,
        ?string $paymentMethod,
        string $notes
    ) {
        $this->id = $id;
        $this->invoiceId = $invoiceId;
        $this->userId = $userId;
        $this->type = $type;
        $this->relId = $relId;
        $this->description = $description;
        $this->amount = $amount;
        $this->taxed = $taxed;
        $this->dueDate = $dueDate;
        $this->paymentMethod = $paymentMethod;
        $this->notes = $notes;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
