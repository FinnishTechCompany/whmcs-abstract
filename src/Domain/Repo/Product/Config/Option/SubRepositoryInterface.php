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

namespace IronLions\WHMCS\Domain\Repo\Product\Config\Option;

use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Exception\InsertFailedException;
use IronLions\WHMCS\Domain\Product\Config\Option\Sub as I;

interface SubRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function getOneById(int $id): I;

    /**
     * @throws EntityNotFoundException
     *
     * @return I[]
     */
    public function getByConfigId(int $id): array;

    public function update(I $sub): void;

    /**
     * @throws InsertFailedException
     */
    public function create(I $sub): I;
}
