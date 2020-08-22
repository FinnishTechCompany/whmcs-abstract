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

namespace IronLions\WHMCS\Utils;

use IronLions\WHMCS\Utils\Extension\AllowExtensionFunctionInterface;
use IronLions\WHMCS\Utils\Hook\CronHookBuilder;

final class HookBuilder implements AllowExtensionFunctionInterface
{
    private ExtensionBuilder $builder;
    private array $hooks = [];

    public function __construct(ExtensionBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function withCron(): CronHookBuilder
    {
        return new CronHookBuilder($this);
    }

    public function registerHooks(): ExtensionBuilder
    {
        $code = "\n\n";
        foreach ($this->hooks as $hook) {
            if (!class_exists($hook['c'])) {
                throw new \LogicException("Invalid command class '$hook[c]' given to hook '$hook[n]'");
            }

            $code .= "add_hook('$hook[n]', $hook[p], function(array \$vars) { \n"
                .('' === $hook['d'] ? '' : "  \$vars = new $hook[d](\$vars);\n")
                .'  '.ExtensionBuilder::KERNEL.PHP_EOL
                .('' === $hook['d']
                    ? "  \$kernel->bus(new $hook[c]());\n"
                    : "  \$kernel->bus(new $hook[c](\$vars));\n")
                ."});\n\n";
        }

        return $this->builder->__addCode($code);
    }

    /**
     * @internal
     */
    public function __addHook(string $name, int $priority, string $command, string $params = ''): void
    {
        $this->hooks[] = [
            'n' => $name,
            'p' => $priority,
            'c' => $command,
            'd' => $params,
        ];
    }
}
