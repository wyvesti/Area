<?php

namespace App;

use App\Controller\HomeController;
use App\Controller\SinglePostController;



class Routes
{
    public static function defineRoutes()
    {
        return [
            "/" => new HomeController(),
            "/post" => new SinglePostController(),
        ];
    }
}
