<?php

namespace App\Service\Torrent;

/**
 * Class BDecodeService
 * @package App\Service\Torrent
 */
class BDecodeService implements BDecodeServiceInterface
{
    /**
     * @inheritDoc
     */
    public function decodeEntry(array $wholefile, int $offset = 0)
    {
        dump($wholefile);
        dump($wholefile[$offset]);

        if ($wholefile[$offset] == 'd') {
            dump('d');
            return $this->decodeDict($wholefile, $offset);
        }

        if ($wholefile[$offset] == 'l') {
            dump('l');
            return $this->decodelist($wholefile, $offset);
        }

        if ($wholefile[$offset] == 'i') {
            dump('i');
            return $this->numberdecode($wholefile, ++$offset);
        }

        // String value: decode number, then grab substring

        $info = $this->numberdecode($wholefile, $offset);
dump($info, $info[0]);
        if ($info[0] === false) {
             return array(false);
        }

        $ret[0] = substr((string)$wholefile, $info[1], $info[0]); dump($ret[0]);
        $ret[1] = $info[1]+strlen($ret[0]); dump($ret[1]);
dump($ret);
        return $ret;
    }

    /**
     * @param array $wholefile
     * @param string $offset
     * @return array|false[]
     */
    private function numberdecode(array $wholefile, string $offset): array
    {
        // Funky handling of negative numbers and zero
        $negative = false;
        if ($wholefile[$offset] == '-') {
            $negative = true;
            $offset++;
        }

        if ($wholefile[$offset] == '0') {
            $offset++;
            if ($negative) {
                return array(false);
            }

            if ($wholefile[$offset] == ':' || $wholefile[$offset] == 'e') {
                return array(0, ++$offset);
            }

            return array(false);
        }

        $ret[0] = 0;
        for(;;) {
            if ($wholefile[$offset] >= '0' && $wholefile[$offset] <= '9') {
                $ret[0] *= 10;
                //Added 2005.02.21 - VisiGod
                //Changing the type of variable from integer to double to prevent a numeric overflow
                settype($ret[0],'double');
                //Added 2005.02.21 - VisiGod
                $ret[0] += ord($wholefile[$offset]) - ord('0');
                $offset++;
            } else if ($wholefile[$offset] == 'e' || $wholefile[$offset] == ':') {
                // Tolerate : or e because this is a multiuse function
                $ret[1] = $offset+1;
                if ($negative) {
                    if ($ret[0] == 0) {
                        return array(false);
                    }

                    $ret[0] = - $ret[0];
                }

                return $ret;
            } else {
                return array(false);
            }
        }
    }

    /**
     * @param array $wholefile
     * @param string $offset
     * @return array|false[]
     */
    private function decodeList(array $wholefile, string $offset): array
    {
        if ($wholefile[$offset] != 'l') {
            return array(false);
        }

        $offset++;
        $ret = array();
        for ($i=0;;$i++) {
            if ($wholefile[$offset] == 'e') {
                break;
            }

            $value = $this->decodeEntry($wholefile, $offset);
            if ($value[0] === false) {
                return array(false);
            }

            $ret[$i] = $value[0];
            $offset = $value[1];
        }

        // The empty list is an empty array. Seems fine.
        return array(0=>$ret, 1=>++$offset);
    }

    /**
     * Tries to construct an array
     * @param array $wholefile
     * @param int $offset
     * @return array|false|false[]
     */
    private function decodeDict(array $wholefile, int $offset = 0)
    {
        if ($wholefile[$offset] == 'l') {
            return $this->decodeList($wholefile, $offset);
        }

        if ($wholefile[$offset] != 'd') {
            return false;
        }

        $ret = [];
        $offset++;
        for (;;) {
            if ($wholefile[$offset] == 'e')	{
                $offset++;
                break;
            }

            $left = $this->decodeEntry($wholefile, $offset);
            if ($left[0] === false) {
                return false;
            }

            $offset = $left[1];
            if ($wholefile[$offset] == 'd') {
                // Recurse
                $value = $this->decodedict($wholefile, $offset);
                if ($value[0]) {
                    $ret[addslashes($left[0])] = $value[0];
                    $offset = $value[1];
                }
                continue;
            }

            if ($wholefile[$offset] === 'l') {
                $value = $this->decodeList($wholefile, $offset);
                if (!$value[0] && is_bool($value[0])) {
                    return false;
                }

                $ret[addslashes($left[0])] = $value[0];
                $offset = $value[1];

                continue;
            }

            $value = $this->decodeEntry($wholefile, $offset);
            if ($value[0] === false) {
                return false;
            }

            $ret[addslashes($left[0])] = $value[0];
            $offset = $value[1];
        }

        return array(0=>(empty($ret)?true:$ret), 1=>$offset);
    }
}
