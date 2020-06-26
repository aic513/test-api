<?php

namespace App\Services;

/**
 * Class IndicatorService
 *
 * @package App\Services
 */
class IndicatorService
{
    /**
     * @param $array
     * @return array|int|string
     * @throws \Exception
     */
    public static function generateIndicatorValue($array)
    {
        switch ($array['type']) {
            case 'guid':
                $value = self::createGUID($array['length']);
                break;
            case 'integer':
                $value = self::getRandomNumber($array['length']);
                break;
            case 'alphanumeric':
                $value = self::getAlphanumeric($array['length']);
                break;
            case 'string':
                $value = self::getRandomString($array['length']);
                break;
            default:
                break;
        }

        return $value;
    }

    /**
     * @param $length
     * @return string
     */
    private static function getAlphanumeric($length)
    {
        $result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($result), 0, $length);
    }

    /**
     * @param $length
     * @return string
     */
    private static function createGUID($length)
    {

        $token = $_SERVER['HTTP_HOST'];
        $token .= $_SERVER['REQUEST_URI'];
        $token .= uniqid(mt_rand(), true);

        $hash = strtoupper(md5($token));

        $guid = '';

        $guid .= substr($hash, 0, $length);

        return $guid;
    }

    /**
     * @param $length
     * @return int
     * @throws \Exception
     */
    private static function getRandomNumber($length)
    {
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= random_int(0, 9);
        }

        return (int)$result;
    }

    /**
     * @param $length
     * @return string
     * @throws \Exception
     */
    private static function getRandomString($length)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKNLMNOPQRSTUVWXYZ';
        $countChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[random_int(1, $countChars) - 1];
        }

        return $string;
    }
}
