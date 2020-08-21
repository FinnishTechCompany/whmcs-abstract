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

namespace IronLions\WHMCS\Domain\Repo;

use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Server;

interface ServerRepositoryInterface
{
    public function getOneById(int $id): Server;

    public function update(Server $invoice): void;

    /**
     * @throws EntityNotFoundException
     */
    public function getOneByType(string $type): Server;
}
