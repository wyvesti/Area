<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\View\ErrorView;
use App\View\UpdateAddView;
use App\View\RedirectView;




class UpdateController extends BaseController
{

    public function doGet(): \App\Core\BaseView
    {
        $id = $_GET["id"];
        if (!empty($id) && is_numeric($id)) {
            $repo = new PostRepository();
            $post = $repo->findById($id);
            if ($post) {
                return new UpdateAddView(post: $post);
            }
        }
        return new ErrorView("This post not exist");
    }

    public function doPost(): \App\Core\BaseView
    {
        $id = $_GET["id"] ?? null;
        if (!$id || !is_numeric($id)) {
            return new ErrorView("Invalid post ID");
        }

        $repo = new PostRepository();
        $existingPost = $repo->findById((int) $id);

        if (!$existingPost) {
            return new ErrorView("Post not found");
        }

        $title = $_POST["title"] ?? null;
        $content = $_POST["content"] ?? null;

        $picture = $existingPost->getPicture();

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
            return new ErrorView("Title and content are required");
        }

        $post = new Post($title, $content, $picture, $existingPost->getCreatedAt(), $existingPost->getUserId());
        $post->setId((int) $id);
        $post->setCategory($existingPost->getCategory());

        $repo->update($post);

        return new RedirectView("/post?id=" . $post->getId());
    }

}

/* public function doPost(): \App\Core\BaseView { // méthode POST
     $repo = new PostRepository(); // dépôt
     if(empty($_POST["title"]) || empty($_POST["content"]) || empty($_POST["category"])) {
         return new FormDogView(error: "info are required", dog: $repo->findById($_GET["id"]));
     }
     $post = new Post($_POST["title"], $_POST["content"], $_POST["picture"], $_GET["createdAt"]);
     $repo->update($post);
     return new RedirectView("/post?id=".$post->getId());
 }*/
