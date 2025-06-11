<?php

namespace App\View;

use App\Core\BaseView;

class RedirectView extends BaseView {
    
    public function __construct(private string $redirectLink) {}

    public function render(): void {
        header("Location: $this->redirectLink");
        exit();
    }
}
