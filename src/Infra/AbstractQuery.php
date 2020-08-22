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
use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;

abstract class AbstractQuery
{
    protected const TBL_GATEWAYS = 'tblpaymentgateways';

    /**
     * @param mixed $id
     *
     * @throws EntityNotFoundException
     */
    protected function _getBy($id, string $column, string $table, int $limit = -1): array
    {
        $arr = em::_table($table)
            ->where($column, '=', $id)
            ->limit($limit)
            ->get()
            ->toArray();

        if ([] === $arr) {
            throw new EntityNotFoundException();
        }

        return $arr;
    }

    protected function _update($id, string $column, string $table, array $map): void
    {
        em::_table($table)
            ->where($column, '=', $id)
            ->update($map);
    }

    protected function _insert(string $table, array $values): int
    {
        return em::_table($table)
            ->insertGetId($values);
    }
}
