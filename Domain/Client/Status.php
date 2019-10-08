<?php
declare(strict_types=1);
/**
 * NOTICE OF LICENSE
 *
 * This source file is released under commercial license by Lamia Oy.
 *
 * @copyright  Copyright (c) Lamia Oy (https://lamia.fi)
 * @author     Niko Grano <niko@lamia.fi>
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
        if (!\in_array($status, self::ALLOWED_VALUES, true))
        {
            throw new EnumValidationException(
                'Invalid value given \''.$status.'\' when allowed values are '.
                \implode(', ', self::ALLOWED_VALUES).'.'
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
        return $this->status === 'Active';
    }

    /**
     * @return bool
     */
    public function isInactive(): bool
    {
        return $this->status === 'Inactive';
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->status === 'Closed';
    }
}