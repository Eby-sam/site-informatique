<?php

namespace App\Routing;

use App\Controller\ArticleController;
use App\Controller\ImageController;
use ErrorController;

class ImageRouter extends AbstractRouter
{
    public static function route(?string $action = null)
    {
        $errorController = new ErrorController();
        $controller = new ImageController();

        if (null === $action) {
            $errorController->error404($action);
        }
        switch ($action) {
            case 'index':
                $controller->index();
                break;
            case 'images':
                $controller->listAllArticles();
                break;
            default:
                $errorController->error404($action);
        }
    }
}

