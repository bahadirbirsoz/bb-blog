<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 12:32
 */

namespace Ayep;


class Helper
{

    CONST TOKEN_LENGTH = 50;

    public static function getNow()
    {
        return date("Y-m-d H:i:s");
    }

    public static function generateToken()
    {
        $str = "";
        $characters = array_merge([], range('A', 'Z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < self::TOKEN_LENGTH; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

}

