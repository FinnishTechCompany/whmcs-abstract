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

namespace IronLions\WHMCS\Infra\Query;

use DateTimeImmutable;
use Exception;
use IronLions\WHMCS\Domain\Hosting as I;
use IronLions\WHMCS\Domain\Repo\HostingRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

class Hosting extends AbstractQuery implements HostingRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    /**
     * @param I $hosting
     */
    public function update(I $hosting): void
    {
        $this->_update(
            $hosting->getId(),
            I::FIELD_ID,
            I::TABLE,
            self::getMap($hosting)
        );
    }

    protected static function getMap(I $hosting): array
    {
        return [
            I::FIELD_USERID                 => $hosting->userId,
            I::FIELD_ORDER_ID               => $hosting->orderId,
            I::FIELD_PACKAGE_ID             => $hosting->packageId,
            I::FIELD_SERVER                 => $hosting->server,
            I::FIELD_REG_DATE               => $hosting->regDate,
            I::FIELD_DOMAIN                 => $hosting->domain,
            I::FIELD_PAYMENT_METHOD         => $hosting->paymentMethod,
            I::FIELD_FIRST_PAYMENT_AMOUNT   => $hosting->firstPaymentAmount,
            I::FIELD_AMOUNT                 => $hosting->amount,
            I::FIELD_BILLING_CYCLE          => $hosting->billingcCcle,
            I::FIELD_NEXT_DUE_DATE          => $hosting->nextDueDate,
            I::FIELD_NEXT_INVOICE_DATE      => $hosting->nextInvoiceDate,
            I::FIELD_TERMINATION_DATE       => $hosting->terminationDate,
            I::FIELD_COMPLETED_DATE         => $hosting->completedDate,
            I::FIELD_DOMAIN_STATUS          => $hosting->domainStatus,
            I::FIELD_USERNAME               => $hosting->username,
            I::FIELD_PASSWORD               => $hosting->password,
            I::FIELD_NOTES                  => $hosting->notes,
            I::FIELD_SUBSCRIPTION_ID        => $hosting->subscriptionId,
            I::FIELD_PROMO_ID               => $hosting->promoId,
            I::FIELD_PROMO_COUNT            => $hosting->promoCount,
            I::FIELD_SUSPEND_REASON         => $hosting->suspendReason,
            I::FIELD_OVERRIDE_AUTO_SUSPEND  => $hosting->overrideAutoSuspend,
            I::FIELD_OVERRIDE_SUSPEND_UNTIL => $hosting->overrideSuspendUntil,
            I::FIELD_DEDICATED_IP           => $hosting->dedicatedIp,
            I::FIELD_ASSIGNED_IPS           => $hosting->assignedIps,
            I::FIELD_NS1                    => $hosting->ns1,
            I::FIELD_NS2                    => $hosting->ns2,
            I::FIELD_DISKUSAGE              => $hosting->diskusage,
            I::FIELD_DISK_LIMIT             => $hosting->diskLimit,
            I::FIELD_BW_USAGE               => $hosting->bwUsage,
            I::FIELD_BW_LIMIT               => $hosting->bwLimit,
            I::FIELD_LAST_UPDATE            => $hosting->lastUpdate,
            I::FIELD_CREATED_AT             => $hosting->created_at,
            I::FIELD_UPDATED_AT             => $hosting->updated_at,
        ];
    }

    /**
     * @throws Exception
     *
     * @return I[]
     */
    protected function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (int) $result->{I::FIELD_USERID},
                (int) $result->{I::FIELD_ORDER_ID},
                (int) $result->{I::FIELD_PACKAGE_ID},
                (int) $result->{I::FIELD_SERVER},
                new DateTimeImmutable($result->{I::FIELD_REG_DATE}),
                (string) $result->{I::FIELD_DOMAIN},
                (string) $result->{I::FIELD_PAYMENT_METHOD},
                (float) $result->{I::FIELD_FIRST_PAYMENT_AMOUNT},
                (float) $result->{I::FIELD_AMOUNT},
                (string) $result->{I::FIELD_BILLING_CYCLE},
                new DateTimeImmutable($result->{I::FIELD_NEXT_DUE_DATE}),
                new DateTimeImmutable($result->{I::FIELD_NEXT_INVOICE_DATE}),
                new DateTimeImmutable($result->{I::FIELD_TERMINATION_DATE}),
                new DateTimeImmutable($result->{I::FIELD_COMPLETED_DATE}),
                (string) $result->{I::FIELD_DOMAIN_STATUS},
                (string) $result->{I::FIELD_USERNAME},
                (string) $result->{I::FIELD_PASSWORD},
                (string) $result->{I::FIELD_NOTES},
                (string) $result->{I::FIELD_SUBSCRIPTION_ID},
                (int) $result->{I::FIELD_PROMO_ID},
                (int) $result->{I::FIELD_PROMO_COUNT},
                (string) $result->{I::FIELD_SUSPEND_REASON},
                (bool) $result->{I::FIELD_OVERRIDE_AUTO_SUSPEND},
                new DateTimeImmutable($result->{I::FIELD_OVERRIDE_SUSPEND_UNTIL}),
                (string) $result->{I::FIELD_DEDICATED_IP},
                (string) $result->{I::FIELD_ASSIGNED_IPS},
                (string) $result->{I::FIELD_NS1},
                (string) $result->{I::FIELD_NS2},
                (int) $result->{I::FIELD_DISKUSAGE},
                (int) $result->{I::FIELD_DISK_LIMIT},
                (int) $result->{I::FIELD_BW_USAGE},
                (int) $result->{I::FIELD_BW_LIMIT},
                new DateTimeImmutable($result->{I::FIELD_LAST_UPDATE}),
                new DateTimeImmutable($result->{I::FIELD_CREATED_AT}),
                new DateTimeImmutable($result->{I::FIELD_UPDATED_AT}),
            );
        }

        return $results;
    }
}
