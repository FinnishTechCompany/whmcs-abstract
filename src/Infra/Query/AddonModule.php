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
use Illuminate\Support\Collection;
use IronLions\WHMCS\App\Service\EntityManager as em;
use IronLions\WHMCS\Domain\AddonModule as C;
use IronLions\WHMCS\Domain\Repo\AddonModuleRepositoryInterface;
use IronLions\WHMCS\Infra\AbstractQuery;

class AddonModule extends AbstractQuery implements AddonModuleRepositoryInterface
{
    /**
     * @throws Exception
     */
    public function getOneById(int $id): C
    {
        /** @var Collection|array $results */
        $results = em::_table(C::TABLE)
            ->where(C::FIELD_ID, '=', $id)
            ->limit(1)
            ->get()
            ->toArray();

        return $this->mapEntity($results)[0];
    }

    public function getByModule(string $module): array
    {
        /** @var Collection|array $results */
        $results = em::_table(C::TABLE)
            ->where(C::FIELD_MODULE, '=', $module)
            ->get()
            ->toArray();

        return $this->mapEntity($results);
    }

    /**
     * @throws Exception
     *
     * @return C[]
     */
    protected function mapEntity(array $results): array
    {
        foreach ($results as &$result) {
            $result = new C(
                (int) $result->{C::FIELD_ID},
                (string) $result->{C::FIELD_MODULE},
                (string) $result->{C::FIELD_SETTING},
                (string) $result->{C::FIELD_VALUE}
            );
        }

        return $results;
    }
}
