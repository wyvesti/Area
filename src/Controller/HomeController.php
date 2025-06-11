<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\PostRepository;
use App\View\HomeView;

class HomeController extends BaseController { 
    protected function doGet(): \App\Core\BaseView {
        $repo = new PostRepository();// instancie le dépôt de chiens
        return new HomeView($repo->findAll());
    }
}