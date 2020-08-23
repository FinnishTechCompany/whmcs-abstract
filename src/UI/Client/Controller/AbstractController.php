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

namespace IronLions\WHMCS\UI\Client\Controller;

use Psr\Container\ContainerInterface;
use Twig\Environment;

abstract class AbstractController
{
    protected ContainerInterface $container;

    /**
     * @required
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    protected function render(array $variables = [], string $view = ''): string
    {
        global $templates_compiledir;
        $twig = new Environment(
            new \Twig\Loader\FilesystemLoader(\dirname(__DIR__, 2).'/Views'),
            [
                'debug'            => true,
                'strict_variables' => true,
                'cache'            => $templates_compiledir,
            ]
        );

        var_dump(static::class);
        die;

        return $twig->render();
    }
}
