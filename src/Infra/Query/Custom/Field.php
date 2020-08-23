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

namespace IronLions\WHMCS\Infra\Query\Custom;

use DateTimeImmutable;
use Exception;
use IronLions\WHMCS\Domain\Custom\Field as I;
use IronLions\WHMCS\Domain\Repo\Custom\FieldRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

class Field extends AbstractQuery implements FieldRepositoryInterface
{
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getBy($id, I::FIELD_ID, I::TABLE, 1))[0];
    }

    /**
     * @param I $field
     */
    public function update(I $field): void
    {
        $this->_update(
            $field->getId(),
            I::FIELD_ID,
            I::TABLE,
            self::getMap($field)
        );
    }

    protected static function getMap(I $field): array
    {
        return [
            I::FIELD_TYPE          => $field->type,
            I::FIELD_REL_ID        => $field->relId,
            I::FIELD_FIELD_NAME    => $field->fieldName,
            I::FIELD_FIELD_TYPE    => $field->fieldType,
            I::FIELD_DESCRIPTION   => $field->description,
            I::FIELD_FIELD_OPTIONS => $field->fieldOptions,
            I::FIELD_REG_EXPR      => $field->regExpr,
            I::FIELD_ADMIN_ONLY    => $field->adminOnly,
            I::FIELD_REQUIRED      => $field->required,
            I::FIELD_SHOW_ORDER    => $field->showOrder,
            I::FIELD_SHOW_INVOICE  => $field->showInvoice,
            I::FIELD_SORT_ORDER    => $field->sortOrder,
            I::FIELD_CREATED_AT    => $field->createdAt,
            I::FIELD_UPDATED_AT    => $field->updatedAt,
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
                (string) $result->{I::FIELD_TYPE},
                (int) $result->{I::FIELD_REL_ID},
                (string) $result->{I::FIELD_FIELD_NAME},
                (string) $result->{I::FIELD_FIELD_TYPE},
                (string) $result->{I::FIELD_DESCRIPTION},
                (string) $result->{I::FIELD_FIELD_OPTIONS},
                (string) $result->{I::FIELD_REG_EXPR},
                (string) $result->{I::FIELD_ADMIN_ONLY},
                (string) $result->{I::FIELD_REQUIRED},
                (string) $result->{I::FIELD_SHOW_ORDER},
                (string) $result->{I::FIELD_SHOW_INVOICE},
                (int) $result->{I::FIELD_SORT_ORDER},
                new DateTimeImmutable($result->{I::FIELD_CREATED_AT}),
                new DateTimeImmutable($result->{I::FIELD_UPDATED_AT}),
            );
        }

        return $results;
    }
}
