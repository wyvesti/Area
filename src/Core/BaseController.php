<?php

namespace App\Core;

class BaseController {
    public function processRequest(): void {

        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->doGet()->render();
        } else {
            $this->doPost()->render();
        }
    }

    protected function doGet(): BaseView {
        throw new \Exception("Controller does not have a doGet");
    }
    protected function doPost(): BaseView {
        throw new \Exception("Controller does not have a doPost");
    }
}

