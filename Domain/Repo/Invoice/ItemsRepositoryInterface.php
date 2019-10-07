<?php

declare(strict_types=1);

/**
 *
 * WHMCS Gateway Fees 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Domain\Repo\Invoice;

use IronLions\WHMCS\Domain\Invoice;

interface ItemsRepositoryInterface
{
    /**
     * @param int $invoiceId
     *
     * @return Invoice\Items[]
     */
    public function getForInvoice(int $invoiceId): array;

    /**
     * @param Invoice\Items $item
     */
    public function store(Invoice\Items $item): void;
}
