<?php


namespace App\Service\Torrent;


interface BEncodeServiceInterface
{
    /**
     * Encodes strings, integers and empty dictionaries.
     * @param boolean $entry
     * @param string $fd
     * @param bool $unstrip is set to true when decoding dictionary keys
     */
    public function encodeEntry(bool $entry, string &$fd, bool $unstrip = false);

    /**
     * Passes lists and dictionaries accordingly, and has encodeEntry handle
     * the strings and integers.
     * @param array $unknown
     * @param string $fd
     * @return string
     */
    public function decideEncode(array $unknown, string &$fd): string;
}
