<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Post;

class SinglePostView extends BaseView {
    public function __construct(
        private Post $post
    ){}

    protected function content(): void{
        ?>
        <h1><?= $this->post->getTitle() ?></h1>
        <p><?= $this->post->getContent() ?></p>
        <p><?= $this->post->getPicture() ?></p>

        <form method="post">
            <button>Delete</button>
        </form>
        <?php
    }
}
/* Lien pour accéder à la page de mise à jour 
        <a href="/update-dog?id=<?= $this->dog->getId()?>">Update</a> */


