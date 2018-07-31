<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 13:51
 */

namespace Ayep\Model;


use Ayep\Controller\Rest;
use Ayep\Helper;
use Ayep\Model;

class Post extends Model
{

    public $post_id;
    public $category_id;
    public $user_id;
    public $title;
    public $content;
    public $status;
    public $created_at;
    public $updated_at;
    public $published_at;

    public function beforeInsert()
    {
        $this->user_id = Rest::getInstance()->getUser()->user_id;
        $this->created_at = Helper::getNow();
    }

    public function publish()
    {
        $this->published_at = Helper::getNow();
        $this->status = "publish";
        $this->save();
    }


    public function unpublish()
    {
        //$this->published_at = Helper::getNow();
        $this->status = "draft";
        $this->save();
    }


    public function beforeUpdate()
    {
        $this->updated_at = Helper::getNow();
    }


}