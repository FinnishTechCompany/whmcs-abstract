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

namespace IronLions\WHMCS\Utils\Hook;

use IronLions\WHMCS\Domain\Params\Hooks\ClientArea\MenuItem;
use IronLions\WHMCS\Utils\HookBuilder;

final class ClientAreaHookBuilder
{
    private HookBuilder $builder;

    public function __construct(HookBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function done(): HookBuilder
    {
        return $this->builder;
    }

    public function withPrimarySidebar(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('ClientAreaPrimarySidebar', $priority, $command, MenuItem::class);

        return $this;
    }
}
