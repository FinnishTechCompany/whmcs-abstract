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

final class TestConnectionParams
{
    public string $whmcsVersion;
    public string $server;
    public string $serverId;
    public string $serverIp;
    public string $serverHostname;
    public string $serverUsername;
    public string $serverPassword;
    public string $serverAccessHash;
    public string $serverSecure;
    public string $serverHttpPrefix;
    public string $serverPort;
    public string $action;

    public function __construct(array $params)
    {
        [
            'whmcsVersion'     => $whmcsVersion,
            'server'           => $server,
            'serverid'         => $serverId,
            'serverip'         => $serverip,
            'serverhostname'   => $serverHostname,
            'serverusername'   => $serverUsername,
            'serverpassword'   => $serverPassword,
            'serveraccesshash' => $serverAccessHash,
            'serversecure'     => $serverSecure,
            'serverhttpprefix' => $serverHttpPrefix,
            'serverport'       => $serverPort,
            'action'           => $action
        ] = $params;

        $this->whmcsVersion = $whmcsVersion;
        $this->server = $server;
        $this->serverId = $serverId;
        $this->serverIp = $serverip;
        $this->serverHostname = $serverHostname;
        $this->serverUsername = $serverUsername;
        $this->serverPassword = $serverPassword;
        $this->serverAccessHash = $serverAccessHash;
        $this->serverSecure = $serverSecure;
        $this->serverHttpPrefix = $serverHttpPrefix;
        $this->serverPort = $serverPort;
        $this->action = $action;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
