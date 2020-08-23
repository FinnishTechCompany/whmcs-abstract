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

use IronLions\WHMCS\Domain\Repo\GatewayRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;
use WHMCS\Database\Capsule;

class Gateway extends AbstractQuery implements GatewayRepositoryInterface
{
    /**
     * @return \IronLions\WHMCS\Domain\Gateway[]
     */
    public function getAll(): array
    {
        $result = Capsule::table(static::TBL_GATEWAYS)
            ->groupBy('gateway')
            ->get();

        foreach ($result as &$item) {
            $item = \IronLions\WHMCS\Domain\Gateway::fromStd($item);
        }

        return $result;
    }
}
