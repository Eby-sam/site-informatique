<?php

namespace App\Controller;

use App\Config;
use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class ImageController extends  AbstractController {

    public function index()
    {
        $this->render('image/image');
    }
}
