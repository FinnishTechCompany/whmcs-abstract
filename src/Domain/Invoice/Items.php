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

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int
     */
    private $invoiceId;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $type;
    /**
     * @var int
     */
    private $relId;
    /**
     * @var string
     */
    private $description;
    /**
     * @var float
     */
    private $amount;
    /**
     * @var bool
     */
    private $taxed;
    /**
     * @var \DateTimeImmutable|null
     */
    private $dueDate;
    /**
     * @var string
     */
    private $paymentMethod;
    /**
     * @var string
     */
    private $notes;

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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getInvoiceId(): int
    {
        return $this->invoiceId;
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getRelId(): int
    {
        return $this->relId;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return bool
     */
    public function isTaxed(): bool
    {
        return $this->taxed;
    }

    /**
     * @return \DateTimeImmutable|null
     */
    public function getDueDate(): ?\DateTimeImmutable
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param int $invoiceId
     *
     * @return Items
     */
    public function setInvoiceId(int $invoiceId): self
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * @param int $userId
     *
     * @return Items
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return Items
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param int $relId
     *
     * @return Items
     */
    public function setRelId(int $relId): self
    {
        $this->relId = $relId;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return Items
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param float $amount
     *
     * @return Items
     */
    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param bool $taxed
     *
     * @return Items
     */
    public function setTaxed(bool $taxed): self
    {
        $this->taxed = $taxed;

        return $this;
    }

    /**
     * @param \DateTimeImmutable|null $dueDate
     *
     * @return Items
     */
    public function setDueDate(?\DateTimeImmutable $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * @param string $paymentMethod
     *
     * @return Items
     */
    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @param string $notes
     *
     * @return Items
     */
    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
