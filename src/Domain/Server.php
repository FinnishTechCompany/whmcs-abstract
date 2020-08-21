<?php

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Domain;

final class Server
{
    public const TABLE = 'tblservers';
    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';
    public const FIELD_IPADDRESS = 'ipaddress';
    public const FIELD_ASSIGNED_IPS = 'assignedips';
    public const FIELD_HOSTNAME = 'hostname';
    public const FIELD_MONTHLY_COST = 'monthlycost';
    public const FIELD_NOC = 'noc';
    public const FIELD_STATUS_ADDRESS = 'statusaddress';
    public const FIELD_NAMESERVER_1 = 'nameserver1';
    public const FIELD_NAMESERVER_1_IP = 'nameserver1ip';
    public const FIELD_NAMESERVER_2 = 'nameserver2';
    public const FIELD_NAMESERVER_2_IP = 'nameserver2ip';
    public const FIELD_NAMESERVER_3 = 'nameserver3';
    public const FIELD_NAMESERVER_3_IP = 'nameserver3ip';
    public const FIELD_NAMESERVER_4 = 'nameserver4';
    public const FIELD_NAMESERVER_4_IP = 'nameserver4ip';
    public const FIELD_NAMESERVER_5 = 'nameserver5';
    public const FIELD_NAMESERVER_5_IP = 'nameserver5ip';
    public const FIELD_MAX_ACCOUNTS = 'maxaccounts';
    public const FIELD_TYPE = 'type';
    public const FIELD_USERNAME = 'username';
    public const FIELD_PASSWORD = 'password';
    public const FIELD_ACCESS_HASH = 'accesshash';
    public const FIELD_SECURE = 'secure';
    public const FIELD_PORT = 'port';
    public const FIELD_ACTIVE = 'active';
    public const FIELD_DISABLED = 'disabled';

    private int $id;
    public string $name;
    public string $ipaddress;
    public string $assignedIPs;
    public string $hostname;
    public float $monthlyCost;
    public string $noc;
    public string $statusAddress;
    public string $nameserver1;
    public string $nameserver1ip;
    public string $nameserver2;
    public string $nameserver2ip;
    public string $nameserver3;
    public string $nameserver3ip;
    public string $nameserver4;
    public string $nameserver4ip;
    public string $nameserver5;
    public string $nameserver5ip;
    public int $maxAccounts;
    public string $type;
    public string $username;
    public string $password;
    public string $accessHash;
    public string $secure;
    public int $port;
    public bool $active;
    public bool $disabled;

    public function __construct(
        int $id,
        string $name,
        string $ipaddress,
        string $assignedIPs,
        string $hostname,
        float $monthlyCost,
        string $noc,
        string $statusAddress,
        string $nameserver1,
        string $nameserver1ip,
        string $nameserver2,
        string $nameserver2ip,
        string $nameserver3,
        string $nameserver3ip,
        string $nameserver4,
        string $nameserver4ip,
        string $nameserver5,
        string $nameserver5ip,
        int $maxAccounts,
        string $type,
        string $username,
        string $password,
        string $accessHash,
        string $secure,
        int $port,
        bool $active,
        bool $disabled
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->ipaddress = $ipaddress;
        $this->assignedIPs = $assignedIPs;
        $this->hostname = $hostname;
        $this->monthlyCost = $monthlyCost;
        $this->noc = $noc;
        $this->statusAddress = $statusAddress;
        $this->nameserver1 = $nameserver1;
        $this->nameserver1ip = $nameserver1ip;
        $this->nameserver2 = $nameserver2;
        $this->nameserver2ip = $nameserver2ip;
        $this->nameserver3 = $nameserver3;
        $this->nameserver3ip = $nameserver3ip;
        $this->nameserver4 = $nameserver4;
        $this->nameserver4ip = $nameserver4ip;
        $this->nameserver5 = $nameserver5;
        $this->nameserver5ip = $nameserver5ip;
        $this->maxAccounts = $maxAccounts;
        $this->type = $type;
        $this->username = $username;
        $this->password = $password;
        $this->accessHash = $accessHash;
        $this->secure = $secure;
        $this->port = $port;
        $this->active = $active;
        $this->disabled = $disabled;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
