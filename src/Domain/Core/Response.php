<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Domain\Core;

use IronLions\WHMCS\App\Http\Dispatcher;
use IronLions\WHMCS\App\Service\Render;

class Response
{
    /**
     * @var string
     */
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function __toString(): string
    {
        return $this->body;
    }

    public static function render(string $view, array $variables = []): self
    {
        $view = "$view.phtml";
        ['file' => $render_file] = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1)[0];
        $render_file = explode('/', $render_file);
        array_pop($render_file);

        if ('Controller' !== end($render_file)) {
            return new self('Error: Subdirectory controllers not supported!');
        }
        array_pop($render_file);
        $render_file = implode(\DIRECTORY_SEPARATOR, $render_file);
        $render_file = "$render_file/Views/$view";

        if (!is_file($render_file)) {
            return new self('Error: Failed to find template! Maybe you need to create it to: '.$render_file);
        }

        $_module = Dispatcher::$vars;
        $variables = array_merge_recursive($variables, $_module);
        $variables['module'] = new Variables($_module['module'], $_module['modulelink'], $_module['version'], $_module['access']);

        return new self((new Render($render_file, $variables))());
    }
}
