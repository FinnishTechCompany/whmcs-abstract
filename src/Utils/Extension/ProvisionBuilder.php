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

namespace IronLions\WHMCS\Utils\Extension;

use IronLions\WHMCS\Utils\Extension\Entrypoint\ExtensionEntrypointInterface;
use IronLions\WHMCS\Utils\Extension\Field\FieldBuilder;
use IronLions\WHMCS\Utils\Extension\Provision\ConfigOptionsBuilder;
use IronLions\WHMCS\Utils\ExtensionBuilder;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class ProvisionBuilder implements AllowExtensionFunctionInterface
{
    private const LOG = 'provisioningmodule';

    private ExtensionBuilder $builder;
    private array $required =
    [
        'withTestConnection' => false,
        'withCreateAccount'  => false,
    ];

    public function __construct(ExtensionBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function withServerMetaData(
        string $displayName,
        bool $requiresServer,
        string $defaultSSLPort,
        string $apiVersion = ExtensionBuilder::API_VERSION_DEFAULT
    ): self {
        $requiresServer = $requiresServer ? 'true' : 'false';
        $code = 'return ['
            ."'DisplayName'    => '$displayName',"
            ."'APIVersion'     => '$apiVersion',"
            ."'RequiresServer' => $requiresServer,"
            ."'DefaultSSLPort' => '$defaultSSLPort'"
            .'];';
        $this->builder->__func('MetaData', $code, 'array');

        return $this;
    }

    public function withConfigOptions(): ConfigOptionsBuilder
    {
        return new ConfigOptionsBuilder($this);
    }

    /**
     * @internal
     */
    public function __addConfigOptions(array $options): void
    {
        /**
         * case FieldBuilder::VALUE_COMMAND:
         * $stamp = HandledStamp::class;
         * $bus = "return \$kernel->bus(new $field[value]())->last($stamp::class)->getResult();\n";
         * $kernel = PHP_EOL.ExtensionBuilder::KERNEL;
         * #$code .= "function() { $kernel\n $bus },\n";
         * $code .= "'',\n";.
         *
         * break;
         */
        $kernel = false;
        $stamp = HandledStamp::class;
        $code = "\nreturn [\n";
        foreach ($options as $optionName => $option) {
            $code .= "'$optionName' => [\n";
            foreach ($option as $fieldName => $field) {
                $code .= " '$fieldName' => ";

                switch ($field['type']) {
                    case FieldBuilder::VALUE_COMMAND:
                        $kernel = true;
                        $code .= "\$kernel->bus(new $field[value]())->last($stamp::class)->getResult(),\n";

                        break;
                    case FieldBuilder::VALUE_LOADER:
                        $kernel = true;
                        $code .= "function() use (\$kernel) { return \$kernel->bus(new $field[value]())->last($stamp::class)->getResult(); },\n";

                        break;
                    case FieldBuilder::VALUE_STRING:
                        $code .= "'$field[value]',\n";

                        break;
                    case FieldBuilder::VALUE_INT:
                        $code .= "$field[value],\n";

                        break;
                    case FieldBuilder::VALUE_BOOL:
                        $code .= ($field['value'] ? 'true' : 'false').",\n";

                        break;
                    case FieldBuilder::VALUE_ARRAY:
                        $code .= var_export($field['value'], true).",\n";
                }
            }
            $code .= " ],\n";
        }
        $code .= '];';

        if ($kernel) {
            $code = $kernel = PHP_EOL.ExtensionBuilder::KERNEL.PHP_EOL.$code;
        }

        $this->builder->__func('ConfigOptions', $code, 'array');
    }

    /**
     * Test connection with the given server parameters.
     *
     * Allows an admin user to verify that an API connection can be
     * successfully made with the given configuration parameters for a
     * server.
     *
     * When defined in a module, a Test Connection button will appear
     * alongside the Server Type dropdown when adding or editing an
     * existing server.
     *
     * @param ExtensionEntrypointInterface[] $entrypoint
     *
     * @return $this
     */
    public function withTestConnection(array $entrypoint): self
    {
        $this->required[__FUNCTION__] = true;
        $this->builder->__entryFunc(
            'TestConnection',
            $entrypoint,
            'array',
            'array $params',
            'IronLions\WHMCS\Domain\Params\Provisioning\TestConnectionParams',
            self::LOG
        );

        return $this;
    }

    /**
     * Provision a new instance of a product/service.
     *
     * Attempt to provision a new instance of a given product/service. This is
     * called any time provisioning is requested inside of WHMCS. Depending upon the
     * configuration, this can be any of:
     * * When a new order is placed
     * * When an invoice for a new order is paid
     * * Upon manual request by an admin user
     */
    public function withCreateAccount(array $entrypoint): self
    {
        $this->required[__FUNCTION__] = true;
        $this->builder->__entryFunc(
            'CreateAccount',
            $entrypoint,
            'string',
            'array $params',
            'IronLions\WHMCS\Domain\Params\Provisioning\ModuleParameters',
            self::LOG
        );

        return $this;
    }

    public function apply(): ExtensionBuilder
    {
        foreach ($this->required as $name => $bool) {
            if (false === $bool) {
                throw new \LogicException("You must call $name!");
            }
        }

        return $this->builder;
    }
}
