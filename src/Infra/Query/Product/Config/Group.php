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

namespace IronLions\WHMCS\Infra\Query\Product\Config;

use IronLions\WHMCS\Domain\Product\Config\Group as I;
use IronLions\WHMCS\Domain\Repo\Product\Config\GroupRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Group extends AbstractQuery implements GroupRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    public function getOneByName(string $name): I
    {
        return $this->mapEntity($this->_getBy($name, I::FIELD_NAME, I::TABLE, 1))[0];
    }

    public function update(I $group): void
    {
        $this->_update($group->getId(), I::FIELD_ID, I::TABLE, [
            I::FIELD_NAME        => $group->name,
            I::FIELD_DESCRIPTION => $group->description,
        ]);
    }

    /**
     * @throws Exception
     *
     * @return I[]
     */
    private function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (string) $result->{I::FIELD_NAME},
                (string) $result->{I::FIELD_DESCRIPTION},
            );
        }

        return $results;
    }
}
