<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Infra\Query;

use Exception;
use Illuminate\Support\Collection;
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\Invoice as I;
use IronLions\WHMCS\Domain\Repo\InvoiceRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Invoice extends AbstractQuery implements InvoiceRepositoryInterface
{
    /**
     * @param int $id
     *
     * @throws Exception
     *
     * @return I
     */
    public function getOneById(int $id): I
    {
        /** @var Collection|array $results */
        $results = em::_table(I::TABLE)
            ->where(I::FIELD_ID, '=', $id)
            ->limit(1)
            ->get();

        return $this->mapEntity($results)[0];
    }

    /**
     * @param I $invoice
     */
    public function update(I $invoice): void
    {
        em::_table(I::TABLE)
            ->where(I::FIELD_ID, '=', $invoice->getId())
            ->update(
                [
                    I::FIELD_INVOICE_NUM            => $invoice->getInvoiceNumber(),
                    I::FIELD_DATE                   => $invoice->getDate(),
                    I::FIELD_DUE_DATE               => $invoice->getDueDate(),
                    I::FIELD_DATE_PAID              => $invoice->getDatePaid(),
                    I::FIELD_LAST_CAPTURE_ATTEMPT   => $invoice->getLastCaptureAttempt(),
                    I::FIELD_SUB_TOTAL              => $invoice->getSubTotal(),
                    I::FIELD_CREDIT                 => $invoice->getCredit(),
                    I::FIELD_TAX_1                  => $invoice->getTax(),
                    I::FIELD_TAX_2                  => $invoice->getTax2(),
                    I::FIELD_TOTAL                  => $invoice->getTotal(),
                    I::FIELD_TAX_RATE_1             => $invoice->getTaxRate(),
                    I::FIELD_TAX_RATE_2             => $invoice->getTaxRate2(),
                    I::FIELD_STATUS                 => $invoice->getStatus(),
                    I::FIELD_PAYMENT_METHOD         => $invoice->getPaymentMethod(),
                    I::FIELD_PAYMENT_METHOD_ID      => $invoice->getPaymentMethodId(),
                    I::FIELD_NOTES                  => $invoice->getNotes(),
                ]
            );
    }

    /**
     * @param array $results
     *
     * @throws Exception
     *
     * @return I[]
     */
    private function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (int) $result->{I::FIELD_USER_ID},
                (string) $result->{I::FIELD_INVOICE_NUM},
                new \DateTimeImmutable($result->{I::FIELD_DATE}),
                new \DateTimeImmutable($result->{I::FIELD_DUE_DATE}),
                new \DateTimeImmutable($result->{I::FIELD_DATE_PAID}),
                new \DateTimeImmutable($result->{I::FIELD_LAST_CAPTURE_ATTEMPT}),
                (float) $result->{I::FIELD_SUB_TOTAL},
                (float) $result->{I::FIELD_CREDIT},
                (float) $result->{I::FIELD_TAX_1},
                (float) $result->{I::FIELD_TAX_2},
                (float) $result->{I::FIELD_TOTAL},
                (float) $result->{I::FIELD_TAX_RATE_1},
                (float) $result->{I::FIELD_TAX_RATE_2},
                (string) $result->{I::FIELD_STATUS},
                (string) $result->{I::FIELD_PAYMENT_METHOD},
                (int) $result->{I::FIELD_PAYMENT_METHOD_ID},
                (string) $result->{I::FIELD_NOTES},
                em::invoiceItems()->getForInvoice((int)$result->{I::FIELD_ID})
            );
        }

        return $results;
    }
}
