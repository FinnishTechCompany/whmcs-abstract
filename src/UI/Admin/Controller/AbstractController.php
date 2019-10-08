<?php

declare(strict_types=1);

/**
 *
 * WHMCS Gateway Fees 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\UI\Admin\Controller;

use IronLions\WHMCS\Domain\Core\Request;
use IronLions\WHMCS\Domain\Core\Variables;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    protected function getVariables(): array
    {
        return $this->request->getVars();
    }

    /**
     * @return Variables
     */
    protected function getModule(): Variables
    {
        $_module = $this->getVariables();

        return new Variables($_module['module'], $_module['modulelink'], $_module['version'], $_module['access']);
    }
}
