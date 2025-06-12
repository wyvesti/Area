<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use App\View\CategoryView;

class CategoryController
{

    public function processRequest(): void
    {
        $this->render();
    }

    public function render(): void
    {
        $categoryRepo = new CategoryRepository();
        $categories = $categoryRepo->findAll();

        $selectedCategory = null;
        $posts = [];

        if (isset($_GET['id'])) {
            $selectedCategory = $categoryRepo->findById((int) $_GET['id']);

            if ($selectedCategory) {
                $postRepo = new PostRepository();
                $posts = $postRepo->findByCategoryId($selectedCategory->getId());
            }
        }

        $view = new CategoryView($categories, $selectedCategory, $posts);
        $view->render();
    }
}
