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

use Exception;
use Illuminate\Support\Collection;
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\Invoice as I;
use IronLions\WHMCS\Domain\Repo\InvoiceRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;
use IronLions\WHMCS\Infra\Query\Invoice\Items;

class Invoice extends AbstractQuery implements InvoiceRepositoryInterface
{
    /**
     * @throws Exception
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
                    I::FIELD_INVOICE_NUM            => $invoice->invoiceNumber,
                    I::FIELD_DATE                   => $invoice->date,
                    I::FIELD_DUE_DATE               => $invoice->dueDate,
                    I::FIELD_DATE_PAID              => $invoice->datePaid,
                    I::FIELD_LAST_CAPTURE_ATTEMPT   => $invoice->lastCaptureAttempt,
                    I::FIELD_SUB_TOTAL              => $invoice->subTotal,
                    I::FIELD_CREDIT                 => $invoice->credit,
                    I::FIELD_TAX_1                  => $invoice->tax,
                    I::FIELD_TAX_2                  => $invoice->tax2,
                    I::FIELD_TOTAL                  => $invoice->total,
                    I::FIELD_TAX_RATE_1             => $invoice->taxRate,
                    I::FIELD_TAX_RATE_2             => $invoice->taxRate2,
                    I::FIELD_STATUS                 => $invoice->status,
                    I::FIELD_PAYMENT_METHOD         => $invoice->paymentMethod,
                    I::FIELD_PAYMENT_METHOD_ID      => $invoice->paymentMethodId,
                    I::FIELD_NOTES                  => $invoice->notes,
                ]
            );
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
                (new Items())->getForInvoice($result->{I::FIELD_ID})
            );
        }

        return $results;
    }
}
