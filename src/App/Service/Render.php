<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\App\Service;

use IronLions\WHMCS\Domain\Core\Variables;

/**
 * @deprecated
 */
final class Render
{
    private string $file;

    private array $variables;

    /**
     * Render constructor.
     */
    public function __construct(string $file, array $variables)
    {
        $this->file = $file;
        $this->variables = $variables;
    }

    protected function getModule(): Variables
    {
        return $this->variables['module'];
    }

    protected function getVars(): array
    {
        return $this->variables;
    }

    protected function getRoute(string $name): void
    {
        echo $this->getModule()->getModulelink().'&action='.Router::getByName($name)->getPath();
    }

    protected function getBlock(string $block): void
    {
        ['file' => $render_file] = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
        $render_file = explode('/', $render_file);
        array_pop($render_file);
        $render_file = implode('/', $render_file);
        $render_file = "$render_file/$block.phtml";

        extract($this->variables, EXTR_SKIP);

        /** @noinspection PhpIncludeInspection */
        require $render_file;
    }

    public function __invoke(): string
    {
        extract($this->variables, EXTR_SKIP);
        ob_start();
        /** @noinspection PhpIncludeInspection */
        require $this->file;
        $render_output = ob_get_clean();

        return \is_string($render_output) ? $render_output : '';
    }
}
