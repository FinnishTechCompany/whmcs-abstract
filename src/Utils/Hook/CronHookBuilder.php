<?php

/**
 *
 * WHMCS Abstract 2020 — NOTICE OF LICENSE
 * This source file is released under commercial license by copyright holders.
 * Please see LICENSE file for more specific licensing terms.
 * @copyright 2017-2020 (c) Niko Granö (https://granö.fi)
 * @copyright 2014-2020 (c) Fiteco (https://fiteco.fi)
 *
 */

namespace IronLions\WHMCS\Utils\Hook;

use IronLions\WHMCS\Domain\Params\Hooks\Cron\PopEmailCollectionCompletedParams;
use IronLions\WHMCS\Domain\Params\Hooks\Cron\PostAutomationTaskParams;
use IronLions\WHMCS\Utils\HookBuilder;

final class CronHookBuilder
{
    private HookBuilder $builder;

    public function __construct(HookBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function done(): HookBuilder
    {
        return $this->builder;
    }

    /**
     * Runs each time that the system calls the system cron job.
     * This occurs after all scheduled tasks finish.
     */
    public function withAfter(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('AfterCronJob', $priority, $command);

        return $this;
    }

    /**
     * Runs at the very end of the daily automation cron execution.
     */
    public function withDaily(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('DailyCronJob', $priority, $command);

        return $this;
    }

    /**
     * Runs after tasks have completed but before email report is sent.
     */
    public function withDailyPreEmail(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('DailyCronJobPreEmail', $priority, $command);

        return $this;
    }

    /**
     * Executes when the POP email collection cron completes.
     *
     * @see PopEmailCollectionCompletedParams
     * An object containing errors if an error occurred while
     * attempting to connect to one or more mailboxes
     */
    public function withPopEmailCollectionCompleted(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('PopEmailCollectionCronCompleted', $priority, $command, PopEmailCollectionCompletedParams::class);

        return $this;
    }

    /**
     * Executes after an automation task occurs.
     *
     * @see PostAutomationTaskParams
     */
    public function withPostAutomationTask(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('PostAutomationTask', $priority, $command, PostAutomationTaskParams::class);

        return $this;
    }

    /**
     * Executes before an automation task occurs.
     */
    public function withPreAutomationTask(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('PreAutomationTask', $priority, $command);

        return $this;
    }

    /**
     * Runs before the daily automation cron execution.
     */
    public function withPreJob(string $command, int $priority = 1): self
    {
        $this->builder->__addHook('PreCronJob', $priority, $command);

        return $this;
    }
}
