<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 13:40
 */

namespace Ayep\Controller;


use Ayep\Error;
use Ayep\Model\Category;
use Ayep\Model\Post;
use Ayep\Success;

class PostController extends Rest
{


    public function postAction()
    {
        $this->requireToken();
        $this->validatePost();
        $postObj = new Post();
        $postObj->status = "draft";
        $postObj->title = $this->getData("title");
        $postObj->content = $this->getData("content");
        $postObj->category_id = $this->getData("category_id");
        $postObj->save();
        $this->success($postObj);
    }

    protected function validatePost()
    {
        $category = Category::findById($this->getData("category_id"));
        if (!$category) {
            Error::RecordNotFound("kategori");
        }

        $this->requireData("title", "content", "category_id");
        $this->failIfHasErrors();

    }


    public function publishAction($id)
    {
        /* @var $postObj Post */
        $postObj = Post::findById($id);
        if (!$postObj) {
            Error::RecordNotFound("başlık");
        }
        $this->failIfHasErrors();

        $postObj->publish();
        $this->success($postObj);
    }


    public function unpublishAction($id)
    {
        /* @var $postObj Post */
        $postObj = Post::findById($id);
        if (!$postObj) {
            Error::RecordNotFound("başlık");
        }
        $this->failIfHasErrors();

        $postObj->unpublish();
        $this->success($postObj);
    }

    public function getAction()
    {

        $data = [];

        if (!$this->hasToken()) {
            $data = ["status" => "publish"];
        }

        $this->success(Post::find($data));
    }


    public function putAction($id)
    {
        $this->requireToken();
        /* @var $postObj Post */
        $postObj = Post::findById($id);
        if (!$postObj) {
            Error::RecordNotFound("başlık");
        }
        $this->validatePost();

        $postObj->title = $this->getData("title");
        $postObj->content = $this->getData("content");
        $postObj->category_id = $this->getData("category_id");

        $postObj->save();
        $this->success($postObj);
    }

    public function deleteAction($id)
    {
        $this->requireToken();
        /* @var $postObj Post */
        $postObj = Post::findById($id);
        if (!$postObj) {
            Error::RecordNotFound("başlık");
        }
        $postObj->remove();
        return $this->success(Success::DeleteSuccessful("başlık"));

    }

}