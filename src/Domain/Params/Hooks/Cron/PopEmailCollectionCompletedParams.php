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

namespace IronLions\WHMCS\Domain\Params\Hooks\Cron;

final class PopEmailCollectionCompletedParams
{
    public array $connectionErrors;

    public function __construct(array $params)
    {
        $this->connectionErrors = $params['connectionErrors'] ?? [];
    }
}
