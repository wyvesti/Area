<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\PostRepository;
use App\View\ErrorView;
use App\View\RedirectView;
use App\View\SinglePostView;

class SinglePostController extends BaseController {
    public function doGet(): \App\Core\BaseView {
        $id = $_GET["id"] ?? null; //recup id
    if (!empty($id) && is_numeric($id)) {
        $repo = new PostRepository(); //instancie le repo
        $post = $repo->findById($id); //chercher le post
        if ($post) {
            return new SinglePostView($post);
        }
    }
    return new ErrorView("Cette page n'existe pas");
    }


    public function doPost(): \App\Core\BaseView{
       $id = $_GET["id"] ?? null; // récupère l’id
        if (!empty($id) && is_numeric($id)) { // vérifie l’id
            $repo = new PostRepository();
            if ($repo->delete($id)){
                return new RedirectView("/");
            }
    }
    return new ErrorView("This not exist");
}
}