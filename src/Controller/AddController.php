<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\View\AddView;
use App\View\RedirectView;
use App\View\ErrorView;

class AddController extends BaseController
{

    protected function doGet(): \App\Core\BaseView
    {
        return new AddView();
    }

    protected function doPost(): \App\Core\BaseView
    {
        $title = $_POST['title'] ?? null;
        $content = $_POST['content'] ?? null;
        $userId = 1;
        $categoryId = $_POST['category'] ?? null;

        $picture = null;

        if (!empty($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . "/../../public/uploads/";
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);

            $fileName = uniqid() . "_" . basename($_FILES["picture"]["name"]);
            $targetFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
                $picture = "/uploads/" . $fileName;
            }
        }

        if (empty($title) || empty($content)) {
            return new AddView("Title and content are required");
        }

        $post = new Post($title, $content, $picture, null, $userId);

        if ($categoryId && is_numeric($categoryId)) {
            //$post->setCategoryId((int)$categoryId)
            $categoryRepo = new CategoryRepository();
            $category = $categoryRepo->findById((int) $categoryId);

            if ($category) {
                $post->setCategory($category);
            }

        }

        $repo = new PostRepository();
        $repo->persist($post);

        return new RedirectView("/post?id=" . $post->getId());
    }
}
