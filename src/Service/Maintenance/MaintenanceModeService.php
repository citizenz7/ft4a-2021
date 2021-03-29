<?php

namespace App\Service\Maintenance;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * Class MaintenanceMode
 * @package App\Service\Maintenance
 */
class MaintenanceModeService implements MaintenanceModeServiceInterface
{
    public static $modeIdentifier = 'maintenance';

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * MaintenanceModeService constructor.
     * @param CacheItemPoolInterface $cache
     */
    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     */
    public function enable(): bool
    {
        /** @var ItemInterface $cacheItem */
        $cacheItem = $this->cache->getItem(self::$modeIdentifier);
        $cacheItem->set(true);
        $this->cache->save($cacheItem);

        return true;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     */
    public function disable(): bool
    {
        $this->cache->deleteItem(self::$modeIdentifier);

        return true;
    }

    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     */
    public function isEnabled(): bool
    {
        /** @var ItemInterface $cacheItem */
        $cacheItem = $this->cache->getItem(self::$modeIdentifier);

        return $cacheItem->isHit();
    }
}
