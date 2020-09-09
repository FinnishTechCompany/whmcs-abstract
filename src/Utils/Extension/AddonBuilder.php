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

final class AddonBuilder implements AllowExtensionFunctionInterface
{
    private const LOG = 'provisioningmodule';
    private const PARAMS = 'array $params';
    private const PARAMS_CLASS = 'IronLions\WHMCS\Domain\Params\Provisioning\ModuleParameters';

    private ExtensionBuilder $builder;
    private array $required =
    [
        'withConfig'   => false,
        'withCreateAccount'    => false,
        'withTerminateAccount' => false,
    ];

    public function __construct(ExtensionBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function withConfig(
        string $name,
        string $description,
        string $version,
        string $author
    ): self {
        $this->required[__FUNCTION__] = true;
        $code = 'return ['
            ."'name'         => '$name',"
            ."'description'  => '$description',"
            ."'version'      => '$version',"
            ."'author'       => '$author'"
            .'];';
        $this->builder->__func('Config', $code, 'array');

        return $this;
    }
}
