<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 12:04
 */

namespace Ayep\Controller;


use Ayep\Error;
use Ayep\Model\Token;
use Ayep\Model\User;

class TokenController extends Rest
{

    public function postAction()
    {
        /* @var $user User */
        $user = User::findOneByEmail($this->getData("email"));
        if (!$user) {
            Error::AuthFail();
            $this->failIfHasErrors();
        }

        if (!$user->checkPassword($this->getData("password"))) {
            Error::AuthFail();
            $this->failIfHasErrors();
        }

        $token = new Token();
        $token->user_id = $user->user_id;
        $token->save();
        $this->success($token);

    }

    public function expireAction()
    {
        $this->requireToken();
        $this->token->expire();
        return $this->success($this->token);
    }


}

