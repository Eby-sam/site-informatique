<?php

namespace App\Controller;

use App\Config;
use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
use App\Model\Manager\UserManager;

class ArticleController extends AbstractController
{

    public const TABLE = 'article';

    public function index()
    {
        $this->render('article/add-article');
    }

    public function listAllArticles()
    {
        $this->render('article/articles');
    }

    /**
     * Route to add a new article.
     * @return void
     */
    public function addArticle()
    {
        self::redirectIfNotConnected();

        if($this->isFormSubmitted()) {

            $user = UserManager::getUser(1);
            $title = $this->sanitizeString($this->getFormField('title'));
            $content = $this->sanitizeString($this->getFormField('content'));
            $image = $this->sanitizeString($this->getFormField('img'));
            $article = new Article();
            $article
                ->setTitle($title)
                ->setContent($content)
                ->setAuthor($user)
                ->setPicture($image)
            ;
            if(ArticleManager::addNewArticle($article)) {
                $this->render('article/show-article', [
                    'article' => $article,
                ]);
            }
        }

        $this->render('article/add-article');
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        $articles = [];
        $query = DB::getPDO()->query("SELECT * FROM " . self::TABLE);
        if($query) {
            $userManager = new UserManager();
            $format = 'Y-m-d H:i:s';

            foreach($query->fetchAll() as $articleData) {
                $articles[] = (new Article())
                    ->setId($articleData['id'])
                    ->setAuthor($userManager->getUser($articleData['user_fk']))
                    ->setContent($articleData['content'])
                    ->setPicture($articleData['picture'])
                    ->setTitle($articleData['title'])
                ;
            }
        }
        $this->render('article/articles');
        return $articles;

    }
}

