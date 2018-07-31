<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 29.07.2018
 * Time: 14:26
 */

namespace Ayep\Controller;


use Ayep\Error;
use Ayep\Model\Category;
use Ayep\Model\Post;
use Ayep\Success;

class CategoryController extends Rest
{

    public function getAction()
    {
        $this->success(Category::find());
    }

    public function postAction()
    {
        $this->requireData("category");
        $category = new  Category();
        $category->category = $this->getData("category");
        $category->save();
        $this->success($category);
    }

    public function updateAction($id)
    {
        /* @var $category Category */
        $category = Category::findById($id);
        if (!$category) {
            Error::RecordNotFound("kategori");
        }
        $this->requireData("category");
        $category->category = $this->getData("category");
        $category->save();
        return $this->success($category);
    }

    public function deleteAction($id)
    {
        /* @var $category Category */
        $category = Category::findById($id);
        if (!$category) {
            Error::RecordNotFound("kategori");
        }

        $count = Post::count([
            "category_id" => $id
        ]);

        if ($count > 0) {
            Error::RelationalData("kategori");
        }
        $this->failIfHasErrors();
        $category->remove();
        $this->success(Success::DeleteSuccessful("kategori"));
    }


}