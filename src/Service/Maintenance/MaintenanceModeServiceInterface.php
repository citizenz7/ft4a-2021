<?php

namespace App\Service\Maintenance;

/**
 * Class MaintenanceModeServiceInterface
 * @package App\Service\Maintenance
 */
interface MaintenanceModeServiceInterface
{
    /**
     * Enables application's maintenance mode.
     * @return bool
     */
    public function enable(): bool;

    /**
     * Disables application's maintenance mode.
     * @return bool
     */
    public function disable(): bool;

    /**
     * Returns true if application is in maintenance mode.
     * @return bool
     */
    public function isEnabled(): bool;
}
