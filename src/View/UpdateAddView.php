<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Post;

class UpdateAddView extends BaseView
{

    public function __construct(private ?Post $post = null)
    {
    }

    protected function content(): void
    {
        ?>
        <h1><?= $this->post ? "Update" : "Add" ?> News</h1>
        <form class="form-post" method="post" enctype="multipart/form-data" action="/update?id=<?= $this->post?->getId() ?>">
            <label>Titre
                <input type="text" name="title" value="<?= $this->post?->getTitle() ?>">
            </label>
            <label>Information
                <input type="text" name="content" value="<?= $this->post?->getContent() ?>">
            </label>
            <label>Image
                <input type="file" name="picture">
            </label>
            <button><?= $this->post ? "Update" : "Add" ?></button>
        </form>
        <?php
    }
}