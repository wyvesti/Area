<?php

namespace App\Core;

use App\View\Part\Footer;
use App\View\Part\Header;

class BaseView {

    protected function content(): void {
        throw new \Exception("Content not defined in the current view");
    }

    public function render(): void {
        $header = new Header();
        $footer = new Footer();

        $header->render();
        $this->content();

        $footer->render();
    }
}

