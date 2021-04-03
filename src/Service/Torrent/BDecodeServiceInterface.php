<?php

namespace App\Service\Torrent;

/**
 * Interface BDecodeServiceInterface
 * @package App\Service\Torrent
 */
interface BDecodeServiceInterface
{
    /**
     * @param array $wholefile
     * @param int $offset
     * @return array|false|false[]
     */
    public function decodeEntry(array $wholefile, int $offset);
}
