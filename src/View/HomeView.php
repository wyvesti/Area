<?php

namespace App\View;

use App\Core\BaseView;

class HomeView extends BaseView
{
    private array $post;
    public function __construct(array $post)
    {
        $this->post = $post;
    }

    protected function content(): void
    {
        foreach ($this->post as $post) {
            echo "<div class='post-preview'>";
            echo "<a href='/post?id=" . $post->getId() . "'>";
            echo "<h2>" . $post->getTitle() . "</h2>";
            echo "<p>" . $post->getContent() . "</p>";
            echo "<img src='" . $post->getPicture() . "' alt=''>";
            echo "</a></div>";
        }
        ?>
        <input type="button" value="+" onclick="window.location='/add';">

        <?php
    }
}
