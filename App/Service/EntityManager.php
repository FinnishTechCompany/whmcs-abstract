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

namespace IronLions\WHMCS\App\Service;

use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use IronLions\WHMCS\Domain\Repo\GatewayRepositoryInterface;
use IronLions\WHMCS\Infra\Query\Gateway;
use WHMCS\Database\Capsule;

/**
 * Class EntityManager.
 */
class EntityManager
{
    /**
     * @return GatewayRepositoryInterface
     */
    public static function gateway(): GatewayRepositoryInterface
    {
        return new Gateway();
    }

    /**
     * Use with caution!
     *
     * @param string      $table
     * @param string|null $as
     * @param string|null $connection
     *
     * @return Builder
     */
    public static function _table(string $table, ?string $as = null, ?string $connection = null): Builder
    {
        return Capsule::table($table, $as, $connection);
    }

    /**
     * Use with caution!
     *
     * @param string|null $connection
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function _schema(?string $connection = null): \Illuminate\Database\Schema\Builder
    {
        return Capsule::schema($connection);
    }

    /**
     * Use with caution!
     *
     * @param string|null $connection
     *
     * @return Connection
     */
    public static function _connection(?string $connection = null): Connection
    {
        return Capsule::connection($connection);
    }
}
