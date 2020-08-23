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

namespace IronLions\WHMCS\Infra;

use IronLions\WHMCS\UI\Client\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class ControllerResolver extends \Symfony\Component\HttpKernel\Controller\ControllerResolver
{
    public function getController(Request $request)
    {
        $controller = parent::getController($request);
        if ($controller instanceof AbstractController) {
            $controller->setContainer(Kernel::__cb());
        }

        return $controller;
    }
}
