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

namespace IronLions\WHMCS\Domain;

final class Gateway
{
    private int $id;
    public string $gateway;
    public string $setting;
    public string $value;
    public int $order;

    /**
     * @return static
     */
    public static function fromStd(\stdClass $item): self
    {
        return new self(
            $item->id,
            $item->gateway,
            $item->setting,
            $item->value,
            $item->order
        );
    }

    /**
     * Gateway constructor.
     */
    public function __construct(
        int $id,
        string $gateway,
        string $setting,
        string $value,
        int $order
    ) {
        $this->id = $id;
        $this->gateway = $gateway;
        $this->setting = $setting;
        $this->value = $value;
        $this->order = $order;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDisplayName(): string
    {
        return ucfirst(empty($this->value) ? $this->gateway : $this->value);
    }
}
