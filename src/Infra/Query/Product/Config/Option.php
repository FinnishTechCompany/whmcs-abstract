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

use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Exception\InsertFailedException;
use IronLions\WHMCS\Domain\Product\Config\Option as I;
use IronLions\WHMCS\Domain\Repo\Product\Config\OptionRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

class Option extends AbstractQuery implements OptionRepositoryInterface
{
    public function create(I $option): I
    {
        $res = $this->_insert(
            I::TABLE,
            [
                I::FIELD_GROUP_ID    => $option->groupId,
                I::FIELD_OPTION_NAME => $option->optionName,
                I::FIELD_OPTION_TYPE => $option->optionType,
                I::FIELD_QTY_MINIMUM => $option->qtyMinimum,
                I::FIELD_QTY_MAXIMUM => $option->qtyMaximum,
                I::FIELD_ORDER       => $option->order,
                I::FIELD_HIDDEN      => $option->hidden,
            ]
        );

        try {
            return $this->getOneById($res);
        } catch (EntityNotFoundException $e) {
            throw new InsertFailedException();
        }
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    /**
     * @throws EntityNotFoundException
     */
    public function getByGroup(int $gid): array
    {
        return $this->mapEntity($this->_getBy($gid, I::FIELD_GROUP_ID, I::TABLE));
    }

    public function update(I $option): void
    {
        $this->_update($option->getId(), I::FIELD_ID, I::TABLE, [
            I::FIELD_GROUP_ID    => $option->groupId,
            I::FIELD_OPTION_NAME => $option->optionName,
            I::FIELD_OPTION_TYPE => $option->optionType,
            I::FIELD_QTY_MINIMUM => $option->qtyMinimum,
            I::FIELD_QTY_MAXIMUM => $option->qtyMaximum,
            I::FIELD_ORDER       => $option->order,
            I::FIELD_HIDDEN      => $option->hidden,
        ]);
    }

    /**
     * @return I[]
     */
    protected function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new I(
                (int) $result->{I::FIELD_ID},
                (int) $result->{I::FIELD_GROUP_ID},
                (string) $result->{I::FIELD_OPTION_NAME},
                (string) $result->{I::FIELD_OPTION_TYPE},
                (int) $result->{I::FIELD_QTY_MINIMUM},
                (int) $result->{I::FIELD_QTY_MAXIMUM},
                (int) $result->{I::FIELD_ORDER},
                (bool) $result->{I::FIELD_HIDDEN},
            );
        }

        return $results;
    }
}
