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

namespace IronLions\WHMCS\Infra\Query\Product\Config\Option;

use IronLions\WHMCS\Domain\Product\Config\Option\Sub as I;
use IronLions\WHMCS\Domain\Repo\Product\Config\Option\SubRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Sub extends AbstractQuery implements SubRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    public function getByConfigId(int $id): array
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_CONFIG_ID, I::TABLE));
    }

    public function create(I $sub): I
    {
        return $this->getOneById($this->_insert(I::TABLE, self::getMap($sub)));
    }

    public function update(I $sub): void
    {
        $this->_update($sub->getId(), I::FIELD_ID, I::TABLE, self::getMap($sub));
    }

    private static function getMap(I $sub): array
    {
        return [
            I::FIELD_CONFIG_ID   => $sub->configId,
            I::FIELD_OPTION_NAME => $sub->optionName,
            I::FIELD_SORT_ORDER  => $sub->sortOrder,
            I::FIELD_HIDDEN      => $sub->hidden,
        ];
    }

    /**
     * @return I[]
     */
    private function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (int) $result->{I::FIELD_CONFIG_ID},
                (string) $result->{I::FIELD_OPTION_NAME},
                (int) $result->{I::FIELD_SORT_ORDER},
                (bool) $result->{I::FIELD_HIDDEN}
            );
        }

        return $results;
    }
}
