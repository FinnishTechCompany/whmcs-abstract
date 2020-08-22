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
use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Repo\ServerRepositoryInterface;
use IronLions\WHMCS\Domain\Server as I;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Server extends AbstractQuery implements ServerRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getOneById(int $id): I
    {
        $r = $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
        if (null === $r) {
            throw new EntityNotFoundException();
        }

        return $r;
    }

    /**
     * @throws Exception
     */
    public function getOneByType(string $type): I
    {
        $r = $this->mapEntity($this->_getBy($type, I::FIELD_TYPE, I::TABLE, 1))[0];
        if (null === $r) {
            throw new EntityNotFoundException();
        }

        return $r;
    }

    /**
     * @param I $server
     */
    public function update(I $server): void
    {
        $this->_update(
            $server->getId(),
            I::FIELD_ID,
            I::TABLE,
            [
                I::FIELD_NAME            => $server->name,
                I::FIELD_IPADDRESS       => $server->ipaddress,
                I::FIELD_ASSIGNED_IPS    => $server->assignedIPs,
                I::FIELD_HOSTNAME        => $server->hostname,
                I::FIELD_MONTHLY_COST    => $server->monthlyCost,
                I::FIELD_NOC             => $server->noc,
                I::FIELD_STATUS_ADDRESS  => $server->statusAddress,
                I::FIELD_NAMESERVER_1    => $server->nameserver1,
                I::FIELD_NAMESERVER_1_IP => $server->nameserver1ip,
                I::FIELD_NAMESERVER_2    => $server->nameserver2,
                I::FIELD_NAMESERVER_2_IP => $server->nameserver2ip,
                I::FIELD_NAMESERVER_3    => $server->nameserver3,
                I::FIELD_NAMESERVER_3_IP => $server->nameserver3ip,
                I::FIELD_NAMESERVER_4    => $server->nameserver4,
                I::FIELD_NAMESERVER_4_IP => $server->nameserver4ip,
                I::FIELD_NAMESERVER_5    => $server->nameserver5,
                I::FIELD_NAMESERVER_5_IP => $server->nameserver5ip,
                I::FIELD_MAX_ACCOUNTS    => $server->maxAccounts,
                I::FIELD_TYPE            => $server->type,
                I::FIELD_USERNAME        => $server->username,
                I::FIELD_PASSWORD        => $server->password,
                I::FIELD_ACCESS_HASH     => $server->accessHash,
                I::FIELD_SECURE          => $server->secure,
                I::FIELD_PORT            => $server->port,
                I::FIELD_ACTIVE          => $server->active,
                I::FIELD_DISABLED        => $server->disabled,
            ]
        );
    }

    /**
     * @throws Exception
     *
     * @return I[]
     */
    private function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (string) $result->{I::FIELD_NAME},
                (string) $result->{I::FIELD_IPADDRESS},
                (string) $result->{I::FIELD_ASSIGNED_IPS},
                (string) $result->{I::FIELD_HOSTNAME},
                (float) $result->{I::FIELD_MONTHLY_COST},
                (string) $result->{I::FIELD_NOC},
                (string) $result->{I::FIELD_STATUS_ADDRESS},
                (string) $result->{I::FIELD_NAMESERVER_1},
                (string) $result->{I::FIELD_NAMESERVER_1_IP},
                (string) $result->{I::FIELD_NAMESERVER_2},
                (string) $result->{I::FIELD_NAMESERVER_2_IP},
                (string) $result->{I::FIELD_NAMESERVER_3},
                (string) $result->{I::FIELD_NAMESERVER_3_IP},
                (string) $result->{I::FIELD_NAMESERVER_4},
                (string) $result->{I::FIELD_NAMESERVER_4_IP},
                (string) $result->{I::FIELD_NAMESERVER_5},
                (string) $result->{I::FIELD_NAMESERVER_5_IP},
                (int) $result->{I::FIELD_MAX_ACCOUNTS},
                (string) $result->{I::FIELD_TYPE},
                (string) $result->{I::FIELD_USERNAME},
                (string) $result->{I::FIELD_PASSWORD},
                (string) $result->{I::FIELD_ACCESS_HASH},
                (string) $result->{I::FIELD_SECURE},
                (int) $result->{I::FIELD_PORT},
                (bool) $result->{I::FIELD_ACTIVE},
                (bool) $result->{I::FIELD_DISABLED}
            );
        }

        return $results;
    }
}
