<?php

use App\Routing\AbstractRouter;
use App\Routing\HomeRouter;

require __DIR__ . '/../includes.php';
session_start();

$page = AbstractRouter::secure($_GET['c']) ?? 'home';
$method = AbstractRouter::secure($_GET['a']) ?? 'index';

switch ($page) {
    case 'home':
        HomeRouter::route();
        break;
    default:
        (new ErrorController())->error404($page);
}