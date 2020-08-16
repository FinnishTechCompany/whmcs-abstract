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

    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $invoiceNumber;
    /**
     * @var \DateTimeImmutable
     */
    private $date;
    /**
     * @var \DateTimeImmutable
     */
    private $dueDate;
    /**
     * @var \DateTimeImmutable
     */
    private $datePaid;
    /**
     * @var \DateTimeImmutable
     */
    private $lastCaptureAttempt;
    /**
     * @var float
     */
    private $subTotal;
    /**
     * @var float
     */
    private $credit;
    /**
     * @var float
     */
    private $tax;
    /**
     * @var float
     */
    private $tax2;
    /**
     * @var float
     */
    private $total;
    /**
     * @var float
     */
    private $taxRate;
    /**
     * @var float
     */
    private $taxRate2;
    /**
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $paymentMethod;
    /**
     * @var int
     */
    private $paymentMethodId;
    /**
     * @var string
     */
    private $notes;
    /**
     * @var array
     */
    private $invoiceItems;

    public function __construct(
        int $id,
        int $userId,
        string $invoiceNumber,
        \DateTimeImmutable $date,
        \DateTimeImmutable $dueDate,
        \DateTimeImmutable $datePaid,
        \DateTimeImmutable $lastCaptureAttempt,
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDueDate(): \DateTimeImmutable
    {
        return $this->dueDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDatePaid(): \DateTimeImmutable
    {
        return $this->datePaid;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getLastCaptureAttempt(): \DateTimeImmutable
    {
        return $this->lastCaptureAttempt;
    }

    /**
     * @return float
     */
    public function getSubTotal(): float
    {
        return $this->subTotal;
    }

    /**
     * @return float
     */
    public function getCredit(): float
    {
        return $this->credit;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }

    /**
     * @return float
     */
    public function getTax2(): float
    {
        return $this->tax2;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    /**
     * @return float
     */
    public function getTaxRate2(): float
    {
        return $this->taxRate2;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return int
     */
    public function getPaymentMethodId(): int
    {
        return $this->paymentMethodId;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @return Items[]
     */
    public function getInvoiceItems(): array
    {
        return $this->invoiceItems;
    }

    /**
     * @param int $userId
     *
     * @return Invoice
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $invoiceNumber
     *
     * @return Invoice
     */
    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $date
     *
     * @return Invoice
     */
    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $dueDate
     *
     * @return Invoice
     */
    public function setDueDate(\DateTimeImmutable $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $datePaid
     *
     * @return Invoice
     */
    public function setDatePaid(\DateTimeImmutable $datePaid): self
    {
        $this->datePaid = $datePaid;

        return $this;
    }

    /**
     * @param \DateTimeImmutable $lastCaptureAttempt
     *
     * @return Invoice
     */
    public function setLastCaptureAttempt(\DateTimeImmutable $lastCaptureAttempt): self
    {
        $this->lastCaptureAttempt = $lastCaptureAttempt;

        return $this;
    }

    /**
     * @param float $subTotal
     *
     * @return Invoice
     */
    public function setSubTotal(float $subTotal): self
    {
        $this->subTotal = $subTotal;

        return $this;
    }

    /**
     * @param float $credit
     *
     * @return Invoice
     */
    public function setCredit(float $credit): self
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * @param float $tax
     *
     * @return Invoice
     */
    public function setTax(float $tax): self
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * @param float $tax2
     *
     * @return Invoice
     */
    public function setTax2(float $tax2): self
    {
        $this->tax2 = $tax2;

        return $this;
    }

    /**
     * @param float $total
     *
     * @return Invoice
     */
    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @param float $taxRate
     *
     * @return Invoice
     */
    public function setTaxRate(float $taxRate): self
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    /**
     * @param float $taxRate2
     *
     * @return Invoice
     */
    public function setTaxRate2(float $taxRate2): self
    {
        $this->taxRate2 = $taxRate2;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return Invoice
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $paymentMethod
     *
     * @return Invoice
     */
    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param int $paymentMethodId
     *
     * @return Invoice
     */
    public function setPaymentMethodId(int $paymentMethodId): self
    {
        $this->paymentMethodId = $paymentMethodId;

        return $this;
    }

    /**
     * @param string $notes
     *
     * @return Invoice
     */
    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @param array $invoiceItems
     *
     * @return Invoice
     */
    public function setInvoiceItems(array $invoiceItems): self
    {
        $this->invoiceItems = $invoiceItems;

        return $this;
    }
}
