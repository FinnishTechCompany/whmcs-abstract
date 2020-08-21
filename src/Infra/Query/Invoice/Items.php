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

namespace IronLions\WHMCS\Infra\Query\Invoice;

use Illuminate\Database\Connection;
use Illuminate\Support\Collection;
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\Invoice;
use IronLions\WHMCS\Domain\Repo\Invoice\ItemsRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Items extends AbstractQuery implements ItemsRepositoryInterface
{
    /**
     * @throws \Exception
     *
     * @return Invoice\Items[]
     */
    public function getForInvoice(int $invoiceId): array
    {
        /** @var Collection|array $items */
        $items = em::_table(Invoice\Items::TABLE)
            ->where(Invoice\Items::FIELD_INVOICE_ID, '=', $invoiceId)
            ->get();

        return $this->mapEntity($items);
    }

    public function store(Invoice\Items $item): void
    {
        if (null === $item->getId()) {
            $this->storeNew($item);
        } else {
            $this->storeOld($item);
        }
    }

    public function drop(int $id): void
    {
        em::_table(Invoice\Items::TABLE)->delete($id);
    }

    public function storeNew(Invoice\Items $item): void
    {
        try {
            em::_connection()
                ->transaction(static function (Connection $connection) use ($item) {
                    $connection
                        ->table(Invoice\Items::TABLE)
                        ->insert(
                            [
                                Invoice\Items::FIELD_ID             => $item->getId(),
                                Invoice\Items::FIELD_INVOICE_ID     => $item->invoiceId,
                                Invoice\Items::FIELD_USER_ID        => $item->userId,
                                Invoice\Items::FIELD_TYPE           => $item->type,
                                Invoice\Items::FIELD_REL_ID         => $item->relId,
                                Invoice\Items::FIELD_DESCRIPTION    => $item->description,
                                Invoice\Items::FIELD_AMOUNT         => $item->amount,
                                Invoice\Items::FIELD_TAXED          => $item->taxed,
                                Invoice\Items::FIELD_DUE_DATE       => $item->dueDate,
                                Invoice\Items::FIELD_PAYMENT_METHOD => $item->paymentMethod,
                                Invoice\Items::FIELD_NOTES          => $item->notes,
                            ]
                        );
                });
        } catch (\Exception | \Throwable $e) {
            // TODO: Logger.
        }
    }

    public function storeOld(Invoice\Items $item): void
    {
        em::_table(Invoice\Items::TABLE)
            ->where(Invoice\Items::FIELD_ID, '=', $item->getId())
            ->update(
                [
                    Invoice\Items::FIELD_INVOICE_ID     => $item->invoiceId,
                    Invoice\Items::FIELD_USER_ID        => $item->userId,
                    Invoice\Items::FIELD_TYPE           => $item->type,
                    Invoice\Items::FIELD_REL_ID         => $item->relId,
                    Invoice\Items::FIELD_DESCRIPTION    => $item->description,
                    Invoice\Items::FIELD_AMOUNT         => $item->amount,
                    Invoice\Items::FIELD_TAXED          => $item->taxed,
                    Invoice\Items::FIELD_DUE_DATE       => $item->dueDate,
                    Invoice\Items::FIELD_PAYMENT_METHOD => $item->paymentMethod,
                    Invoice\Items::FIELD_NOTES          => $item->notes,
                ]
            );
    }

    /**
     * @throws \Exception
     *
     * @return Invoice\Items[]
     */
    private function mapEntity(array $items): array
    {
        foreach ($items as &$item) {
            $dueDate = null === $item->{Invoice\Items::FIELD_DUE_DATE} ?
                null : new \DateTimeImmutable($item->{Invoice\Items::FIELD_DUE_DATE});

            $item = new Invoice\Items(
                (int) $item->{Invoice\Items::FIELD_ID},
                (int) $item->{Invoice\Items::FIELD_INVOICE_ID},
                (int) $item->{Invoice\Items::FIELD_USER_ID},
                (string) $item->{Invoice\Items::FIELD_TYPE},
                (int) $item->{Invoice\Items::FIELD_REL_ID},
                (string) $item->{Invoice\Items::FIELD_DESCRIPTION},
                (float) $item->{Invoice\Items::FIELD_AMOUNT},
                (bool) $item->{Invoice\Items::FIELD_TAXED},
                $dueDate,
                (string) $item->{Invoice\Items::FIELD_PAYMENT_METHOD},
                (string) $item->{Invoice\Items::FIELD_NOTES}
            );
        }

        return $items;
    }
}
