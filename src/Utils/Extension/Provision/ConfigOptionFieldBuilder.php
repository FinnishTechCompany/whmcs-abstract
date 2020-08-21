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

final class ConfigOptionFieldBuilder extends FieldBuilder
{
    public function next(): ConfigOptionsBuilder
    {
        $this->builder->__addOption($this->name, $this->fields);
        // @noinspection PhpIncompatibleReturnTypeInspection
        return $this->builder;
    }
}
