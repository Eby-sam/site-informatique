<?php

use App\Routing\AbstractRouter;
use App\Routing\HomeRouter;
use App\Routing\ArticleRouter;


require __DIR__ . '/../includes.php';
session_start();

$page = isset($_GET['c']) ? AbstractRouter::secure($_GET['c']) : 'home';
$method = isset($_GET['a']) ? AbstractRouter::secure($_GET['a']) : 'index';

switch ($page) {
    case 'home':
        HomeRouter::route();
        break;
    case 'article':
        ArticleRouter::route($method);
    default:
        (new ErrorController())->error404($page);
}