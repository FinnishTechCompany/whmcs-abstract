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

namespace IronLions\WHMCS\Infra;

use IronLions\WHMCS\App\Service\EntityManager as em;

abstract class AbstractQuery
{
    protected const TBL_GATEWAYS = 'tblpaymentgateways';

    protected function _getBy($id, string $column, string $table, int $limit = 0): array
    {
        return em::_table($table)
            ->where($column, '=', $id)
            ->limit($limit)
            ->get()
            ->toArray();
    }

    protected function _update($id, string $column, string $table, array $map): void
    {
        em::_table($table)
            ->where($column, '=', $id)
            ->update($map);
    }
}
