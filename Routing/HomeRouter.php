<?php

namespace App\Routing;

use App\Controller\ArticleController;
use ErrorController;
use HomeController;

class HomeRouter extends AbstractRouter
{
    /**
     * @return void
     */
    public static function route(?string $action = null)
    {
        (new HomeController())->index();
    }



}
