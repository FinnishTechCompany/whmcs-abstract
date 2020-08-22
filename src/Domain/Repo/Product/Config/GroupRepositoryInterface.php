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

namespace IronLions\WHMCS\Domain\Repo\Product\Config;

use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Exception\InsertFailedException;
use IronLions\WHMCS\Domain\Product\Config\Group;

interface GroupRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function getOneById(int $id): Group;

    /**
     * @throws EntityNotFoundException
     */
    public function getOneByName(string $name): Group;

    public function update(Group $group): void;

    /**
     * @throws InsertFailedException
     */
    public function create(Group $group): Group;
}
