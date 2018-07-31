<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 12:47
 */

namespace Ayep\Model;


use Ayep\Helper;
use Ayep\Model;

class Token extends Model
{

    public $token_id;
    public $user_id;
    public $token;
    public $created_at;
    public $expired_at;

    public function beforeInsert()
    {
        $this->token = Helper::generateToken();
        $this->created_at = Helper::getNow();
    }

    public function expire()
    {
        $this->expired_at = Helper::getNow();
        $this->save();
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return !is_null($this->expired_at);
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return User::findById($this->user_id);
    }

}