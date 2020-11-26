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

use IronLions\WHMCS\Utils\ExtensionBuilder;

final class AddonBuilder implements AllowExtensionFunctionInterface
{
    private const LOG = 'provisioningmodule';
    private const PARAMS = 'array $params';
    private const PARAMS_CLASS = 'IronLions\WHMCS\Domain\Params\Provisioning\ModuleParameters';

    private ExtensionBuilder $builder;
    private array $required =
    [
        'withConfig'           => false,
        'withCreateAccount'    => false,
        'withTerminateAccount' => false,
    ];

    public function __construct(ExtensionBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function done(): ExtensionBuilder
    {
        return $this->builder;
    }

    public function withClientArea(
        string $title,
        bool $requireLogin = true,
        string $defaultTemplate = 'templates/default.tpl'
    ): self {
        $login = $requireLogin ? 'true' : 'false';

        $code = PHP_EOL.'  '.ExtensionBuilder::KERNEL.PHP_EOL
            ."  \$res = \$kernel->handle();\n"
            ."  \$kernel->terminate();\n"
            ."\n  return [\n"
            ."    'pagetitle' => '$title',\n"
            ."    'templatefile' => '$defaultTemplate',\n"
            ."    'requirelogin' => '$login',\n"
            ."    'vars' => [\n"
            ."      'abstractContent' => \$res->getContent(),\n"
            ."    ],\n"
            .'  ];';

        $this->builder->__func(
            'clientarea',
            $code,
            'array',
            self::PARAMS
        );

        return $this;
    }

    public function withAdminArea(): self
    {
        $code = PHP_EOL.'  '.ExtensionBuilder::KERNEL.PHP_EOL
            ."  \$res = \$kernel->handle();\n"
            ."  \$kernel->terminate();\n"
            ." echo \$res->getContent(); \n"
            ."\n  return \$res->getContent();\n";

        $this->builder->__func(
            'output',
            $code,
            'string',
            self::PARAMS
        );

        return $this;
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
