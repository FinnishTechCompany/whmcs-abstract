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

namespace IronLions\WHMCS\Domain\Client;

use IronLions\WHMCS\Domain\Exception\EnumValidationException;

final class Status
{
    /**
     * @var string[]
     */
    public const ALLOWED_VALUES = ['Active', 'Inactive', 'Closed'];
    /**
     * @var string
     */
    private $status;

    /**
     * Status constructor.
     *
     * @param string $status
     */
    public function __construct(string $status)
    {
        if (!\in_array($status, self::ALLOWED_VALUES, true)) {
            throw new EnumValidationException(
                'Invalid value given \''.$status.'\' when allowed values are '.
                implode(', ', self::ALLOWED_VALUES).'.'
            );
        }
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return 'Active' === $this->status;
    }

    /**
     * @return bool
     */
    public function isInactive(): bool
    {
        return 'Inactive' === $this->status;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return 'Closed' === $this->status;
    }
}
