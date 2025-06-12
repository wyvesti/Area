<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\View\ErrorView;
use App\View\UpdateAddView;
use App\View\RedirectView;




class UpdateController extends BaseController {

    public function doGet(): \App\Core\BaseView {
        $id = $_GET["id"]; // récupère l’id
        if (!empty($id) && is_numeric($id)) {
            $repo = new PostRepository(); // instancie dépôt
            $post = $repo->findById($id); // trouve
            if ($post) {
                return new UpdateAddView(post: $post); // retourne formulaire avec chien pré-rempli
            }
        }
        return new ErrorView("This post not exist"); // erreur
    }

     public function doPost(): \App\Core\BaseView {
    $id = $_GET["id"] ?? null;
    if (!$id || !is_numeric($id)) {
        return new ErrorView("Invalid post ID");
    }

    $repo = new PostRepository();
    $existingPost = $repo->findById((int)$id);

    if (!$existingPost) {
        return new ErrorView("Post not found");
    }

    // Récupération des champs
    $title = $_POST["title"] ?? null;
    $content = $_POST["content"] ?? null;

    // Gestion de l’image
    $picture = $existingPost->getPicture(); // on garde l’image actuelle si aucune nouvelle n’est fournie

    if (!empty($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . "/../../public/uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = uniqid() . "_" . basename($_FILES["picture"]["name"]);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
            $picture = "/uploads/" . $fileName;
        }
    }

    // Validation minimale
    if (empty($title) || empty($content)) {
        return new ErrorView("Title and content are required");
    }

    // Création de l’objet Post avec la date de création d’origine
    $post = new Post($title, $content, $picture, $existingPost->getCreatedAt(),$existingPost->getUserId());
    $post->setId((int)$id);
    $post->setCategory($existingPost->getCategory());

    $repo->update($post);

    return new RedirectView("/post?id=" . $post->getId());
}

}

   /* public function doPost(): \App\Core\BaseView { // méthode POST
        $repo = new PostRepository(); // dépôt
        if(empty($_POST["title"]) || empty($_POST["content"]) || empty($_POST["category"])) { // champs manquants
            return new FormDogView(error: "info are required", dog: $repo->findById($_GET["id"])); // retourne formulaire avec erreur
        }
        $post = new Post($_POST["title"], $_POST["content"], $_POST["picture"], $_GET["createdAt"]); // crée un chien avec id
        $repo->update($post); // met à jour le chien
        return new RedirectView("/post?id=".$post->getId()); // redirige vers la fiche du chien
    }*/
