<?php

namespace App\View;

use App\Core\BaseView;

class HomeView extends BaseView {
    private array $post; //tableau avec tout les post

    public function __construct(array $post){
        $this->post = $post; //stock la liste de post
    }

    protected function content(): void{
        foreach ($this->post as $post) {
            echo "<a href='/post?id=" . $post->getId() . "'>" . $post->getTitle() . $post->getContent() . $post->getPicture() . "</a>";
        }
    }
}
