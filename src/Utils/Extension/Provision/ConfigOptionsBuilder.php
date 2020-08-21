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

namespace IronLions\WHMCS\Utils\Extension\Provision;

use IronLions\WHMCS\Utils\Extension\Field\FieldBuilder;
use IronLions\WHMCS\Utils\Extension\ProvisionBuilder;

final class ConfigOptionsBuilder
{
    private ProvisionBuilder $builder;
    private array $fields;

    public function __construct(ProvisionBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function text(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_TEXT);
    }

    public function pass(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_PASS);
    }

    public function dropdown(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_DROP);
    }

    public function checkbox(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_BOX);
    }

    public function radio(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_RADIO);
    }

    public function textArea(string $name): ConfigOptionFieldBuilder
    {
        return new ConfigOptionFieldBuilder($this, $name, FieldBuilder::TYPE_AREA);
    }

    public function done(): ProvisionBuilder
    {
        $this->builder->__addConfigOptions($this->fields);

        return $this->builder;
    }

    /**
     * @internal
     */
    public function __addOption(string $name, array $fields): void
    {
        $this->fields[$name] = $fields;
    }
}
