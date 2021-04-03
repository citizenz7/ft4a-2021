<?php

namespace App\Service\Torrent;

/**
 * Class BEncodeService
 * @package App\Service\Torrent
 */
class BEncodeService implements BEncodeServiceInterface
{
    /**
     * @inheritDoc
     */
    public function encodeEntry(bool $entry, string &$fd, bool $unstrip = false)
    {
        if (is_bool($entry)) {
            $fd .= 'de';
            return;
        }
        if (is_int($entry) || is_float($entry)) {
            $fd .= 'i'.$entry.'e';
            return;
        }

        if ($unstrip) {
            $myentry = stripslashes($entry);
        } else {
            $myentry = $entry;
        }

        $length = strlen($myentry);
        $fd .= $length.':'.$myentry;
    }

    /**
     * Dictionary keys must be sorted. foreach tends to iterate over the order
     * the array was made, so we make a new one in sorted order. :)
     * @param array $array
     * @return array
     */
    private function makeSorted(array $array): array
    {
        // Shouldn't happen!
        if (empty($array)) {
            return $array;
        }

        $i = 0;
        foreach($array as $key => $dummy) {
            $keys[$i++] = stripslashes($key);
        }

        $return = [];
        sort($keys);
        for ($i=0; isset($keys[$i]); $i++) {
            $return[addslashes($keys[$i])] = $array[addslashes($keys[$i])];
        }

        return $return;
    }

    /**
     * Encodes lists
     * @param array $array
     * @param string $fd
     * @return string|void
     */
    private function encodeList(array $array, string &$fd)
    {
        $fd .= 'l';

        // The empty list is defined as array();
        if (empty($array)) {
            $fd .= 'e';
            return;
        }

        for ($i = 0; isset($array[$i]); $i++) {
            $this->decideEncode($array[$i], $fd);
        }

        return $fd .= 'e';
    }

    /**
     * @inheritDoc
     */
    public function decideEncode(array $unknown, string &$fd): string
    {
        if (is_array($unknown)) {
            if (isset($unknown[0]) || empty($unknown)) {
                return $this->encodeList($unknown, $fd);
            } else {
                return $this->encodeDict((bool)$unknown, $fd);
            }
        }

        return $this->encodeEntry((bool)$unknown, $fd);
    }

    /**
     * Encodes dictionaries
     * @param bool $array
     * @param string $fd
     */
    private function encodeDict(bool $array, string &$fd)
    {
        $fd .= 'd';

        if (is_bool($array)) {
            $fd .= 'e';
            return;
        }

        // NEED TO SORT!
        $newarray = $this->makeSorted($array);
        foreach($newarray as $left => $right) {
            $this->encodeEntry($left, $fd, true);
            $this->decideEncode($right, $fd);
        }

        $fd .= 'e';
    }
}
