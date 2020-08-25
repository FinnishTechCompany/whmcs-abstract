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

namespace IronLions\WHMCS\App\Service;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use WHMCS\Database\Capsule;

class EntityManager
{
    /**
     * Use with caution!
     */
    public static function _table(string $table, ?string $as = null, ?string $connection = null): Builder
    {
        return Capsule::table($table, $as, $connection);
    }

    /**
     * Use with caution!
     */
    public static function _schema(?string $connection = null): \Illuminate\Database\Schema\Builder
    {
        return Capsule::schema($connection);
    }

    /**
     * Use with caution!
     */
    public static function _connection(?string $connection = null): Connection
    {
        return Capsule::connection($connection);
    }
}
