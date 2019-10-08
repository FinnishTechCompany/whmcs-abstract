<?php

declare(strict_types=1);

/**
 *
 * WHMCS Abstract 2019 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2019 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2019 (c) IronLions (https://ironlions.fi)
 *
 */

namespace IronLions\WHMCS\Domain\Core;

final class Route
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string[]
     */
    private $allowedMethods;
    /**
     * @var bool
     */
    private $adminArea;
    /**
     * @var string
     */
    private $action;
    /**
     * @var string
     */
    private $name;

    public function __construct(
        string $name,
        string $path,
        string $controller,
        string $action,
        bool $adminArea = true,
        array $allowedMethods = ['GET']
    ) {
        $this->path = $path;
        $this->controller = $controller;
        $this->allowedMethods = $allowedMethods;
        $this->adminArea = $adminArea;
        $this->action = $action;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string[]
     */
    public function getAllowedMethods(): array
    {
        return $this->allowedMethods;
    }

    /**
     * @return bool
     */
    public function isAdminArea(): bool
    {
        return $this->adminArea;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isAllowed(string $method): bool
    {
        return \in_array(strtoupper($method), $this->allowedMethods, true);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
