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

namespace IronLions\WHMCS\Utils\Extension\Entrypoint;

final class BusEntrypoint implements ExtensionEntrypointInterface
{
    private string $command;
    private array $args;

    public function __construct(string $command, string ...$args)
    {
        $this->command = $command;
        $this->args = $args;
    }

    public function __toString(): string
    {
        $args = implode(', ', $this->args);

        return "\$kernel->bus(new $this->command($args));";
    }
}
