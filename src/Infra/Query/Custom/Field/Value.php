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

namespace IronLions\WHMCS\Infra\Query\Custom\Field;

use DateTimeImmutable;
use Exception;
use IronLions\WHMCS\Domain\Custom\Field;
use IronLions\WHMCS\Domain\Custom\Field\Value as I;
use IronLions\WHMCS\Domain\Repo\Custom\Field\ValueRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Value extends AbstractQuery implements ValueRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    public function getByFieldId(Field $field): array
    {
        return $this->mapEntity($this->_getBy($field->getId(), I::FIELD_ID, I::TABLE));
    }

    /**
     * @param I $value
     */
    public function update(I $value): void
    {
        $this->_update(
            $value->getId(),
            I::FIELD_ID,
            I::TABLE,
            self::getMap($value)
        );
    }

    private static function getMap(I $field): array
    {
        return [
            I::FIELD_FIELD_ID          => $field->fieldId,
            I::FIELD_REL_ID            => $field->relId,
            I::FIELD_VALUE             => $field->value,
            I::FIELD_CREATED_AT        => $field->createdAt,
            I::FIELD_UPDATED_AT        => $field->updatedAt,
        ];
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
                (int) $result->{I::FIELD_FIELD_ID},
                (int) $result->{I::FIELD_REL_ID},
                (string) $result->{I::FIELD_VALUE},
                new DateTimeImmutable($result->{I::FIELD_CREATED_AT}),
                new DateTimeImmutable($result->{I::FIELD_UPDATED_AT}),
            );
        }

        return $results;
    }
}
