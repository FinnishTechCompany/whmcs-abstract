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

namespace IronLions\WHMCS\Domain;

use DateTimeImmutable;
use IronLions\WHMCS\Domain\Invoice\Items;

final class Invoice
{
    public const TABLE = 'tblinvoices';
    public const FIELD_ID = 'id';
    public const FIELD_USER_ID = 'userid';
    public const FIELD_INVOICE_NUM = 'invoicenum';
    public const FIELD_DATE = 'date';
    public const FIELD_DUE_DATE = 'duedate';
    public const FIELD_DATE_PAID = 'datepaid';
    public const FIELD_LAST_CAPTURE_ATTEMPT = 'last_capture_attempt';
    public const FIELD_SUB_TOTAL = 'subtotal';
    public const FIELD_CREDIT = 'credit';
    public const FIELD_TAX_1 = 'tax';
    public const FIELD_TAX_2 = 'tax2';
    public const FIELD_TOTAL = 'total';
    public const FIELD_TAX_RATE_1 = 'taxrate';
    public const FIELD_TAX_RATE_2 = 'taxrate2';
    public const FIELD_STATUS = 'status';
    public const FIELD_PAYMENT_METHOD = 'paymentmethod';
    public const FIELD_PAYMENT_METHOD_ID = 'paymethodid';
    public const FIELD_NOTES = 'notes';

    private int $id;
    public int $userId;
    public string $invoiceNumber;
    public DateTimeImmutable $date;
    public DateTimeImmutable $dueDate;
    public DateTimeImmutable $datePaid;
    public DateTimeImmutable $lastCaptureAttempt;
    public float $subTotal;
    public float $credit;
    public float $tax;
    public float $tax2;
    public float $total;
    public float $taxRate;
    public float $taxRate2;
    public string $status;
    public string $paymentMethod;
    public int $paymentMethodId;
    public string $notes;
    /**
     * @var Items[]
     */
    public array $invoiceItems;

    public function __construct(
        int $id,
        int $userId,
        string $invoiceNumber,
        DateTimeImmutable $date,
        DateTimeImmutable $dueDate,
        DateTimeImmutable $datePaid,
        DateTimeImmutable $lastCaptureAttempt,
        float $subTotal,
        float $credit,
        float $tax,
        float $tax2,
        float $total,
        float $taxRate,
        float $taxRate2,
        string $status,
        string $paymentMethod,
        int $paymentMethodId,
        string $notes,
        array $invoiceItems
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->invoiceNumber = $invoiceNumber;
        $this->date = $date;
        $this->dueDate = $dueDate;
        $this->datePaid = $datePaid;
        $this->lastCaptureAttempt = $lastCaptureAttempt;
        $this->subTotal = $subTotal;
        $this->credit = $credit;
        $this->tax = $tax;
        $this->tax2 = $tax2;
        $this->total = $total;
        $this->taxRate = $taxRate;
        $this->taxRate2 = $taxRate2;
        $this->status = $status;
        $this->paymentMethod = $paymentMethod;
        $this->paymentMethodId = $paymentMethodId;
        $this->notes = $notes;
        $this->invoiceItems = $invoiceItems;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
