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
use IronLions\WHMCS\Domain\Repo\ClientRepositoryInterface;
use IronLions\WHMCS\Domain\Repo\GatewayRepositoryInterface;
use IronLions\WHMCS\Domain\Repo\Invoice\ItemsRepositoryInterface as InvoiceItemsRepositoryInterface;
use IronLions\WHMCS\Domain\Repo\InvoiceRepositoryInterface;
use IronLions\WHMCS\Infra\Query\Client;
use IronLions\WHMCS\Infra\Query\Gateway;
use IronLions\WHMCS\Infra\Query\Invoice;
use WHMCS\Database\Capsule;

/**
 * Class EntityManager.
 */
class EntityManager
{
    /**
     * @return ClientRepositoryInterface
     */
    public static function client(): ClientRepositoryInterface
    {
        return new Client();
    }

    /**
     * @return GatewayRepositoryInterface
     */
    public static function gateway(): GatewayRepositoryInterface
    {
        return new Gateway();
    }

    /**
     * @return InvoiceRepositoryInterface
     */
    public static function invoice(): InvoiceRepositoryInterface
    {
        return new Invoice();
    }

    /**
     * @return InvoiceItemsRepositoryInterface
     */
    public static function invoiceItems(): InvoiceItemsRepositoryInterface
    {
        return new Invoice\Items();
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
