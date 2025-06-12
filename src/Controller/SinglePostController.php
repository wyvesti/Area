<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\PostRepository;
use App\View\ErrorView;
use App\View\RedirectView;
use App\View\SinglePostView;

class SinglePostController extends BaseController
{
    public function doGet(): \App\Core\BaseView
    {
        $id = $_GET["id"] ?? null;
        if (!empty($id) && is_numeric($id)) {
            $repo = new PostRepository();
            $post = $repo->findById($id);
            if ($post) {
                return new SinglePostView($post);
            }
        }
        return new ErrorView("Cette page n'existe pas");
    }


    public function doPost(): \App\Core\BaseView
    {
        $id = $_GET["id"] ?? null;
        if (!empty($id) && is_numeric($id)) {
            $repo = new PostRepository();
            if ($repo->delete($id)) {
                return new RedirectView("/");
            }
        }
        return new ErrorView("This not exist");
    }
}