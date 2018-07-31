<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 28.07.2018
 * Time: 13:21
 */

namespace Ayep\Model;


use Ayep\Helper;
use Ayep\Model;

class User extends Model
{

    public $user_id;
    public $email;
    protected $password;
    public $first_name;
    public $last_name;
    public $role;
    public $created_at;
    public $updated_at;


    public function beforeInsert()
    {
        $this->created_at = Helper::getNow();
    }

    public function beforeUpdate()
    {
        $this->updated_at = Helper::getNow();
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }

    public function checkPassword($password)
    {
        return $this->password == sha1($password);
    }

}

