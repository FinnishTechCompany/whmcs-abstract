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

namespace IronLions\WHMCS\Domain\Params\Provisioning;

use WHMCS\Service\Service;

final class ModuleParameters
{
    public string $whmcsVersion;
    public int $accountId;
    public int $serviceId;
    public int $addonId;
    public int $userId;
    public string $domain;
    public string $username;
    public string $password;
    public int $packageId;
    public int $pid;
    public int $serverId;
    public string $status;
    public string $type;
    public string $productType;
    public string $moduleType;
    public string $configOption1;
    public string $configOption2;
    public string $configOption3;
    public string $configOption4;
    public string $configOption5;
    public string $configOption6;
    public string $configOption7;
    public string $configOption8;
    public string $configOption9;
    public string $configOption10;
    public string $configOption11;
    public string $configOption12;
    public string $configOption13;
    public string $configOption14;
    public string $configOption15;
    public string $configOption16;
    public string $configOption17;
    public string $configOption18;
    public string $configOption19;
    public string $configOption20;
    public string $configOption21;
    public string $configOption22;
    public string $configOption23;
    public string $configOption24;
    public array $customFields;
    public array $configOptions;
    public Service $model;
    public bool $server;
    public string $serverIp;
    public string $serverHostname;
    public string $serverUsername;
    public string $serverPassword;
    public string $serverAccessHash;
    public bool $serverSecure;
    public string $serverHttpPrefix;
    public string $serverPort;
    public string $action;
    public array $client;

    public function __construct(array $params)
    {
        /** @var Service $model */
        [
            'whmcsVersion'      => $whmcsVersion,
            'accountid'         => $accountId,
            'serviceid'         => $serviceId,
            'addonId'           => $addonId,
            'userid'            => $userId,
            'domain'            => $domain,
            'username'          => $username,
            'password'          => $password,
            'packageid'         => $packageId,
            'pid'               => $pid,
            'serverid'          => $serverId,
            'status'            => $status,
            'type'              => $type,
            'producttype'       => $productType,
            'moduletype'        => $moduleType,
            'configoption1'     => $configOption1,
            'configoption2'     => $configOption2,
            'configoption3'     => $configOption3,
            'configoption4'     => $configOption4,
            'configoption5'     => $configOption5,
            'configoption6'     => $configOption6,
            'configoption7'     => $configOption7,
            'configoption8'     => $configOption8,
            'configoption9'     => $configOption9,
            'configoption10'    => $configOption10,
            'configoption11'    => $configOption11,
            'configoption12'    => $configOption12,
            'configoption13'    => $configOption13,
            'configoption14'    => $configOption14,
            'configoption15'    => $configOption15,
            'configoption16'    => $configOption16,
            'configoption17'    => $configOption17,
            'configoption18'    => $configOption18,
            'configoption19'    => $configOption19,
            'configoption20'    => $configOption20,
            'configoption21'    => $configOption21,
            'configoption22'    => $configOption22,
            'configoption23'    => $configOption23,
            'configoption24'    => $configOption24,
            'customfields'      => $customFields,
            'configoptions'     => $configOptions,
            'model'             => $model,
            'server'            => $server,
            'serverip'          => $serverIp,
            'serverhostname'    => $serverHostname,
            'serverusername'    => $serverUsername,
            'serverpassword'    => $serverPassword,
            'serveraccesshash'  => $serverAccessHash,
            'serversecure'      => $serverSecure,
            'serverhttpprefix'  => $serverHttpPrefix,
            'serverport'        => $serverPort,
            'clientsdetails'    => $client,
            'action'            => $action
        ] = $params;

        $this->whmcsVersion = $whmcsVersion;
        $this->accountId = $accountId;
        $this->serviceId = $serviceId;
        $this->addonId = $addonId;
        $this->userId = $userId;
        $this->domain = $domain;
        $this->username = $username;
        $this->password = $password;
        $this->packageId = $packageId;
        $this->pid = $pid;
        $this->serverId = $serverId;
        $this->status = $status;
        $this->type = $type;
        $this->productType = $productType;
        $this->moduleType = $moduleType;
        $this->configOption1 = $configOption1;
        $this->configOption2 = $configOption2;
        $this->configOption3 = $configOption3;
        $this->configOption4 = $configOption4;
        $this->configOption5 = $configOption5;
        $this->configOption6 = $configOption6;
        $this->configOption7 = $configOption7;
        $this->configOption8 = $configOption8;
        $this->configOption9 = $configOption9;
        $this->configOption10 = $configOption10;
        $this->configOption11 = $configOption11;
        $this->configOption12 = $configOption12;
        $this->configOption13 = $configOption13;
        $this->configOption14 = $configOption14;
        $this->configOption15 = $configOption15;
        $this->configOption16 = $configOption16;
        $this->configOption17 = $configOption17;
        $this->configOption18 = $configOption18;
        $this->configOption19 = $configOption19;
        $this->configOption20 = $configOption20;
        $this->configOption21 = $configOption21;
        $this->configOption22 = $configOption22;
        $this->configOption23 = $configOption23;
        $this->configOption24 = $configOption24;
        $this->customFields = $customFields;
        $this->configOptions = $configOptions;
        $this->model = $model;
        $this->server = $server;
        $this->serverIp = $serverIp;
        $this->serverHostname = $serverHostname;
        $this->serverUsername = $serverUsername;
        $this->serverPassword = $serverPassword;
        $this->serverAccessHash = $serverAccessHash;
        $this->serverSecure = $serverSecure;
        $this->serverHttpPrefix = $serverHttpPrefix;
        $this->serverPort = $serverPort;
        $this->action = $action;
        $this->client = $client;
    }
}
