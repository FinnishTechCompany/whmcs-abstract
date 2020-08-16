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
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $gateway;

    /**
     * @var string
     */
    private $setting;

    /**
     * @var string
     */
    private $value;

    /**
     * @var int
     */
    private $order;

    /**
     * @param \stdClass $item
     *
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
     *
     * @param int    $id
     * @param string $gateway
     * @param string $setting
     * @param string $value
     * @param int    $order
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGateway(): string
    {
        return $this->gateway;
    }

    /**
     * @return string
     */
    public function getSetting(): string
    {
        return $this->setting;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return ucfirst(empty($this->getValue()) ? $this->getGateway() : $this->getValue());
    }
}
