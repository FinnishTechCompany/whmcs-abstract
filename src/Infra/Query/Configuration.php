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

namespace IronLions\WHMCS\Infra\Query;

use Exception;
use IronLions\WHMCS\Domain\Configuration as I;
use IronLions\WHMCS\Domain\Repo\ConfigurationRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

final class Configuration extends AbstractQuery implements ConfigurationRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getOneById(int $id): I
    {
        return $this->mapEntity($this->_getOneBy($id, I::FIELD_ID, I::TABLE))[0];
    }

    /**
     * @throws Exception
     */
    public function getOneBySetting(string $setting): I
    {
        return $this->mapEntity($this->_getOneBy($setting, I::FIELD_SETTING, I::TABLE))[0];
    }

    /**
     * @param I $invoice
     */
    public function update(I $configuration): void
    {
        $this->_update(
            $configuration->getId(),
            I::FIELD_ID,
            I::TABLE,
            [
                I::FIELD_SETTING     => $configuration->setting,
                I::FIELD_VALUE       => $configuration->value,
                I::FIELD_CREATED_AT  => $configuration->createdAt,
                I::FIELD_UPDATED_AT  => $configuration->updatedAt,
            ]
        );
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
                (string) $result->{I::FIELD_SETTING},
                (string) $result->{I::FIELD_VALUE},
                new \DateTimeImmutable($result->{I::FIELD_CREATED_AT}),
                new \DateTimeImmutable($result->{I::FIELD_UPDATED_AT}),
            );
        }

        return $results;
    }
}
