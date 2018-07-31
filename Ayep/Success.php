<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 14:48
 */

namespace Ayep;


class Success
{

    public $message;

    public static function _($message)
    {
        $obj = new Success();
        $obj->message = $message;
        return $obj;
    }

    public static function DeleteSuccessful($what)
    {
        return self::_("$what kaydı başarıyla silindi.");
    }


}