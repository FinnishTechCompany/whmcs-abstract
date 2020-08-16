<?php


namespace IronLions\WHMCS\Domain\Params\Provisioning;


final class TestConnectionParams
{
    /** @var string */
    public $whmcsVersion;
    /** @var string */
    public $server;
    /** @var string */
    public $serverId;
    /** @var string */
    public $serverIp;
    /** @var string */
    public $serverHostname;
    /** @var string */
    public $serverUsername;
    /** @var string */
    public $serverPassword;
    /** @var string */
    public $serverAccessHash;
    /** @var string */
    public $serverSecure;
    /** @var string */
    public $serverHttpPrefix;
    /** @var string */
    public $serverPort;
    /** @var string */
    public $action;

    public function __construct(array $params) {
        [
            'whmcsVersion' => $whmcsVersion,
            'server' => $server,
            'serverid' => $serverid,
            'serverip' => $serverip,
            'serverhostname' => $serverhostname,
            'serverusername' => $serverusername,
            'serverpassword' => $serverpassword,
            'serveraccesshash' => $serveraccesshash,
            'serversecure' => $serversecure,
            'serverhttpprefix' => $serverhttpprefix,
            'serverport' => $serverport,
            'action' => $action
        ] = $params;

        $this->whmcsVersion = $whmcsVersion;
        $this->server = $server;
        $this->serverId = $serverid;
        $this->serverIp = $serverip;
        $this->serverHostname = $serverhostname;
        $this->serverUsername = $serverusername;
        $this->serverPassword = $serverpassword;
        $this->serverAccessHash = $serveraccesshash;
        $this->serverSecure = $serversecure;
        $this->serverHttpPrefix = $serverhttpprefix;
        $this->serverPort = $serverport;
        $this->action = $action;
    }

    public function toArray(): array {
        return get_object_vars($this);
    }
}
