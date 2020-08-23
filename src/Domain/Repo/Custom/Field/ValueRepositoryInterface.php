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

namespace IronLions\WHMCS\Domain\Repo\Custom\Field;

use IronLions\WHMCS\Domain\Custom\Field;
use IronLions\WHMCS\Domain\Custom\Field\Value as I;
use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;

interface ValueRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function getOneById(int $id): I;

    /**
     * @return I[]
     */
    public function getByFieldId(Field $field): array;

    /**
     * @return I[]
     */
    public function getByRefId(int $id): array;

    public function update(I $value): void;

    /**
     * @throws EntityNotFoundException
     */
    public function create(I $value): int;
}
