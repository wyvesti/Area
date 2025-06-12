<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Category;
use App\Entity\Post;

class CategoryView extends BaseView
{
    public function __construct(
        private array $categories,
        private ?Category $selectedCategory,
        private array $posts
    ) {
    }

    protected function content(): void
    {
        echo "<h1>Catégories</h1><ul>";

        foreach ($this->categories as $category) {
            echo "<li><a href='/category?id=" . $category->getId() . "'>" . $category->getName() . "</a></li>";
        }

        echo "</ul>";

        if ($this->selectedCategory) {
            echo "<h2>Posts dans la category: " . $this->selectedCategory->getName() . "</h2>";

            if (empty($this->posts)) {
                echo "<p>Aucun post dans cette category.</p>";
            } else {
                foreach ($this->posts as $post) {
                    echo "<div class='post-preview'>";
                    echo "<h3>" . $post->getTitle() . "</h3>";
                    echo "<p>" . $post->getContent() . "</p>";
                    echo "<p>Posté le : " . $post->getCreatedAt() . "</p>";
                    echo "<img src='" . $post->getPicture() . "' alt=''>";
                    echo "</div>";
                }
            }
        }
    }
}
