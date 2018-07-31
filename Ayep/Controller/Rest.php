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

class Rest
{

    private $requestData = null;

    /**
     * @var Token
     */
    protected $token = null;

    /**
     * @var User
     */
    protected $user = null;

    /**
     * @var Rest
     */
    static $instance;

    /**
     * @return Rest
     */
    public static function getInstance()
    {
        return static::$instance;
    }

    public function __construct()
    {
        static::$instance = $this;
        $this->loadToken();
    }

    public function getData($key = null)
    {
        if (is_null($this->requestData)) {
            $this->setData();
        }

        if (is_null($key)) {
            return $this->requestData;
        }

        return $this->requestData->$key;

    }

    private function setData()
    {

        $str = file_get_contents("php://input");

        parse_str($str, $arr);
        $this->requestData = json_decode(json_encode($arr));

    }

    public function hasData($key)
    {
        $data = $this->getData();
        return isset($data->$key);
    }

    public function success($data)
    {
        header("Content-Type: application/json");
        echo json_encode([
            "status" => 200,
            "data" => $data
        ]);
    }


    public function fail()
    {
        header("Content-Type: application/json");
        echo json_encode([
            "status" => 400,
            "data" => Error::getErrors()
        ]);
        die;
    }

    public function requireData(...$parameters)
    {
        foreach ($parameters as $key) {
            if (!$this->hasData($key)) {
                Error::RequiredData($key);
            }
        }
        $this->failIfHasErrors();

    }

    protected function loadToken()
    {
        if (!array_key_exists("HTTP_TOKEN", $_SERVER)) {
            return;
        }
        $token = $_SERVER['HTTP_TOKEN'];
        $tokenObj = Token::findOneByToken($token);

        if ($tokenObj) {
            $this->token = $tokenObj;
            $this->user = $tokenObj->getUser();
        }

    }

    public function requireToken()
    {
        if (!array_key_exists("HTTP_TOKEN", $_SERVER)) {
            Error::TokenNotExists();
            $this->failIfHasErrors();
        }

        if (!$this->token || $this->token->isExpired()) {
            Error::InvalidToken();
            $this->failIfHasErrors();
        }
    }

    public function hasToken()
    {
        return !is_null($this->token);
    }

    /**
     * @return Token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function failIfHasErrors()
    {
        if (Error::hasError()) {
            $this->fail();
        }
    }


}