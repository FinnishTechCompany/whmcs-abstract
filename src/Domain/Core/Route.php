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

namespace IronLions\WHMCS\Domain\Core;

final class Route
{
    private string $path;
    private string $controller;
    private bool $adminArea;
    private string $action;
    private string $name;
    /**
     * @var string[]
     */
    private array $allowedMethods;

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

    public function getPath(): string
    {
        return $this->path;
    }

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

    public function isAdminArea(): bool
    {
        return $this->adminArea;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function isAllowed(string $method): bool
    {
        return \in_array(strtoupper($method), $this->allowedMethods, true);
    }

    public function getName(): string
    {
        return $this->name;
    }
}
