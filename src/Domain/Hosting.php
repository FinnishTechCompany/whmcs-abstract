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

final class Hosting
{
    public const TABLE = 'tblhosting';

    public const FIELD_ID = 'id';
    public const FIELD_USERID = 'userid';
    public const FIELD_ORDER_ID = 'orderid';
    public const FIELD_PACKAGE_ID = 'packageid';
    public const FIELD_SERVER = 'server';
    public const FIELD_REG_DATE = 'regdate';
    public const FIELD_DOMAIN = 'domain';
    public const FIELD_PAYMENT_METHOD = 'paymentmethod';
    public const FIELD_FIRST_PAYMENT_AMOUNT = 'firstpaymentamount';
    public const FIELD_AMOUNT = 'amount';
    public const FIELD_BILLING_CYCLE = 'billingcycle';
    public const FIELD_NEXT_DUE_DATE = 'nextduedate';
    public const FIELD_NEXT_INVOICE_DATE = 'nextinvoicedate';
    public const FIELD_TERMINATION_DATE = 'termination_date';
    public const FIELD_COMPLETED_DATE = 'completed_date';
    public const FIELD_DOMAIN_STATUS = 'domainstatus';
    public const FIELD_USERNAME = 'username';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_NOTES = 'notes';
    public const FIELD_SUBSCRIPTION_ID = 'subscriptionid';
    public const FIELD_PROMO_ID = 'promoid';
    public const FIELD_PROMO_COUNT = 'promocount';
    public const FIELD_SUSPEND_REASON = 'suspendreason';
    public const FIELD_OVERRIDE_AUTO_SUSPEND = 'overideautosuspend';
    public const FIELD_OVERRIDE_SUSPEND_UNTIL = 'overidesuspenduntil';
    public const FIELD_DEDICATED_IP = 'dedicatedip';
    public const FIELD_ASSIGNED_IPS = 'assignedips';
    public const FIELD_NS1 = 'ns1';
    public const FIELD_NS2 = 'ns2';
    public const FIELD_DISKUSAGE = 'diskusage';
    public const FIELD_DISK_LIMIT = 'disklimit';
    public const FIELD_BW_USAGE = 'bwusage';
    public const FIELD_BW_LIMIT = 'bwlimit';
    public const FIELD_LAST_UPDATE = 'lastupdate';
    public const FIELD_CREATED_AT = 'created_at';
    public const FIELD_UPDATED_AT = 'updated_at';

    public const DOMAIN_STATUS = [
        self::DOMAIN_STATUS_PENDING,
        self::DOMAIN_STATUS_ACTIVE,
        self::DOMAIN_STATUS_SUSPENDED,
        self::DOMAIN_STATUS_TERMINATED,
        self::DOMAIN_STATUS_CANCELLED,
        self::DOMAIN_STATUS_FRAUD,
        self::DOMAIN_STATUS_COMPLETED,
    ];

    public const DOMAIN_STATUS_PENDING = 'Pending';
    public const DOMAIN_STATUS_ACTIVE = 'Active';
    public const DOMAIN_STATUS_SUSPENDED = 'Suspended';
    public const DOMAIN_STATUS_TERMINATED = 'Terminated';
    public const DOMAIN_STATUS_CANCELLED = 'Cancelled';
    public const DOMAIN_STATUS_FRAUD = 'Fraud';
    public const DOMAIN_STATUS_COMPLETED = 'Completed';

    private int $id;
    public int $userId;
    public int $orderId;
    public int $packageId;
    public int $server;
    public DateTimeImmutable $regDate;
    public string $domain;
    public string $paymentMethod;
    public float $firstPaymentAmount;
    public float $amount;
    public string $billingcCcle;
    public DateTimeImmutable $nextDueDate;
    public DateTimeImmutable $nextInvoiceDate;
    public DateTimeImmutable $terminationDate;
    public DateTimeImmutable $completedDate;
    public string $domainStatus;
    public string $username;
    public string $password;
    public string $notes;
    public string $subscriptionId;
    public int $promoId;
    public int $promoCount;
    public string $suspendReason;
    public bool $overrideAutoSuspend;
    public DateTimeImmutable $overrideSuspendUntil;
    public string $dedicatedIp;
    public string $assignedIps;
    public string $ns1;
    public string $ns2;
    public int $diskusage;
    public int $diskLimit;
    public int $bwUsage;
    public int $bwLimit;
    public DateTimeImmutable $lastUpdate;
    public DateTimeImmutable $created_at;
    public DateTimeImmutable $updated_at;

    public function __construct(
        int $id,
        int $userId,
        int $orderId,
        int $packageId,
        int $server,
        DateTimeImmutable $regDate,
        string $domain,
        string $paymentMethod,
        float $firstPaymentAmount,
        float $amount,
        string $billingcCcle,
        DateTimeImmutable $nextDueDate,
        DateTimeImmutable $nextInvoiceDate,
        DateTimeImmutable $terminationDate,
        DateTimeImmutable $completedDate,
        string $domainStatus,
        string $username,
        string $password,
        string $notes,
        string $subscriptionId,
        int $promoId,
        int $promoCount,
        string $suspendReason,
        bool $overrideAutoSuspend,
        DateTimeImmutable $overrideSuspendUntil,
        string $dedicatedIp,
        string $assignedIps,
        string $ns1,
        string $ns2,
        int $diskusage,
        int $diskLimit,
        int $bwUsage,
        int $bwLimit,
        DateTimeImmutable $lastUpdate,
        DateTimeImmutable $created_at,
        DateTimeImmutable $updated_at
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->packageId = $packageId;
        $this->server = $server;
        $this->regDate = $regDate;
        $this->domain = $domain;
        $this->paymentMethod = $paymentMethod;
        $this->firstPaymentAmount = $firstPaymentAmount;
        $this->amount = $amount;
        $this->billingcCcle = $billingcCcle;
        $this->nextDueDate = $nextDueDate;
        $this->nextInvoiceDate = $nextInvoiceDate;
        $this->terminationDate = $terminationDate;
        $this->completedDate = $completedDate;
        $this->domainStatus = $domainStatus;
        $this->username = $username;
        $this->password = $password;
        $this->notes = $notes;
        $this->subscriptionId = $subscriptionId;
        $this->promoId = $promoId;
        $this->promoCount = $promoCount;
        $this->suspendReason = $suspendReason;
        $this->overrideAutoSuspend = $overrideAutoSuspend;
        $this->overrideSuspendUntil = $overrideSuspendUntil;
        $this->dedicatedIp = $dedicatedIp;
        $this->assignedIps = $assignedIps;
        $this->ns1 = $ns1;
        $this->ns2 = $ns2;
        $this->diskusage = $diskusage;
        $this->diskLimit = $diskLimit;
        $this->bwUsage = $bwUsage;
        $this->bwLimit = $bwLimit;
        $this->lastUpdate = $lastUpdate;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
