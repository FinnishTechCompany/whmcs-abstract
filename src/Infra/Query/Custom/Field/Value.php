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
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\Custom\Field;
use IronLions\WHMCS\Domain\Custom\Field\Value as I;
use IronLions\WHMCS\Domain\Exception\EntityNotFoundException;
use IronLions\WHMCS\Domain\Hosting;
use IronLions\WHMCS\Domain\Repo\Custom\Field\ValueRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

class Value extends AbstractQuery implements ValueRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    public function getByFieldId(Field $field): array
    {
        return $this->mapEntity($this->_getBy($field->getId(), I::FIELD_ID, I::TABLE));
    }

    public function getByRefId(int $id): array
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_REL_ID, I::TABLE));
    }

    public function getOneByRefAndFieldId(Field $field, Hosting $hosting): I
    {
        $arr = em::_table(I::TABLE)
            ->where(I::FIELD_FIELD_ID, '=', $field->getId())
            ->where(I::FIELD_REL_ID, '=', $hosting->getId())
            ->limit(1)
            ->get()
            ->toArray();

        if ([] === $arr) {
            throw new EntityNotFoundException();
        }

        return $this->mapEntity($arr)[0];
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

    public function create(I $value): int
    {
        return $this->_insert(I::TABLE, self::getMap($value));
    }

    protected static function getMap(I $field): array
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
    protected function mapEntity(array $results): array
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
