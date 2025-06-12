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
        <div class="post-preview">
    <h1><?= $this->post->getTitle() ?></h1>
    <p><?= $this->post->getContent() ?></p>
    <p>Posté le : <?= $this->post->getCreatedAt() ?></p>
    <img src="<?= $this->post->getPicture() ?>" alt="Image du post">
    <p>
        Catégorie :
        <a href="/category?id=<?= $this->post->getCategory()?->getId() ?>">
            <?= $this->post->getCategory()?->getName() ?>
        </a>
    </p>
    <form method="post">
        <button>Delete</button>
    </form>
    <a href="/update?id=<?= $this->post->getId() ?>" class="button-link">Update</a>
</div>

        <?php

        
    }
}


