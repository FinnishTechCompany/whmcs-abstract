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

namespace IronLions\WHMCS\Domain\Repo\Custom;

use IronLions\WHMCS\Domain\Custom\Field as I;
use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;

interface FieldRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function getOneById(int $id): I;

    public function update(I $field): void;
}
