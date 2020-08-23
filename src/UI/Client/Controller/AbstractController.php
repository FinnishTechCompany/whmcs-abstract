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
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

    protected function render(array $variables = [], string $view = ''): Response
    {
        global $templates_compiledir;
        $filename = (new \ReflectionClass(static::class))->getFileName();
        $twig = new Environment(
            new FilesystemLoader(\dirname($filename, 2).'/Views'),
            [
                'debug'            => true,
                'strict_variables' => true,
                'cache'            => $templates_compiledir,
            ]
        );

        if ('' === $view) {
            $ns = explode('\\', static::class);
            $view = str_replace('Controller', '', end($ns));
        }

        return new Response($twig->render($view.'.twig', $variables));
    }
}
