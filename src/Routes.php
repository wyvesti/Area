<?php

namespace App;

use App\Controller\AddController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\SinglePostController;
use App\Controller\UpdateController;



class Routes
{
    public static function defineRoutes()
    {
        return [
            "/" => new HomeController(),
            "/post" => new SinglePostController(),
            "/category" => new CategoryController(),
            "/update" => new UpdateController(),
            "/add" => new AddController(),
        ];
    }
}
