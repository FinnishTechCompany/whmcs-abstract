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

namespace IronLions\WHMCS\Domain\Params\Hooks\ClientArea;

use WHMCS\View\Menu\Item;

final class MenuItem
{
    public Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }
}
