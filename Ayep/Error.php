<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 13:21
 */

namespace Ayep;


class Error
{

    public $code;
    public $message;

    static $errors = [];

    public function __construct()
    {
        static::$errors[] = $this;
    }

    public static function hasError()
    {
        return count(static::$errors) > 0;
    }

    /**
     * @return Error[]
     */
    public static function getErrors()
    {
        return static::$errors;
    }

    public static function _($code, $message)
    {
        $err = new static();
        $err->code = $code;
        $err->message = $message;
        return $err;
    }

    public static function TokenNotExists()
    {
        return static::_("AUTH-01", "Talep içerisinde 'TOKEN' başlığı bulunamadı.");
    }


    public static function InvalidToken()
    {
        return static::_("AUTH-02", "Talep içerisinde bulunan 'TOKEN' başlığı geçersiz.");
    }

    public static function AuthFail()
    {
        return static::_("AUTH-03", "Hatalı e-posta ya da şifre.");
    }

    public static function RecordNotFound($what)
    {
        return static::_("DATA-01", ucfirst(strtolower($what)) .
            " kaydı bulunamadı.");
    }

    public static function InvalidData($what)
    {
        return static::_("DATA-02", "Geçersiz $what bilgisi.");
    }

    public static function RequiredData($what)
    {
        return static::_("DATA-03", "Talepte $what alanı bulunamadı.");
    }

    public static function RelationalData($what)
    {
        return static::_("DATA-04", "Veritabanında $what ögesine ilişkili kayıtlar mevcut.");
    }

}