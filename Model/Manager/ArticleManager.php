<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Article;

class ArticleManager
{
    public const TABLE = 'article';

    public function getArticles(): array
    {
        $articles = [];
        $query = DB::getPDO()->query("SELECT * FROM article WHERE id BETWEEN 1 AND 4 ");
        if($query) {
            $userManager = new UserManager();

            foreach($query->fetchAll() as $articleData) $articles[] = (new Article())
                ->setId($articleData['id'])
                ->setAuthor($userManager->getUser($articleData['user_fk']))
                ->setTitle($articleData['title'])
            ;
        }

        return $articles;
    }

    /**
     * Return all users.
     * @return array
     */
    public function findAll(): array
    {
        $articles = [];
        $query = DB::getPDO()->query("SELECT * FROM article ORDER BY id DESC");
        if($query) {
            $userManager = new UserManager();

            foreach($query->fetchAll() as $articleData) $articles[] = (new Article())
                ->setId($articleData['id'])
                ->setTitle($articleData['title'])
                ->setContent($articleData['content'])
            ;
        }

        return $articles;
    }

    /**
     * Add a new article into the db.
     * @param Article $article
     * @return void
     */
    public static function addNewArticle(Article &$article): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO ". self::TABLE ." (title, content,picture, author) VALUES (:title, :picture, :content, :author)
        ");

        $stmt->bindValue(':title', $article->getTitle());
        $stmt->bindValue(':picture', $article->getPicture());
        $stmt->bindValue(':content', $article->getContent());
        $stmt->bindValue(':author', $article->getAuthor()->getId());

        $result = $stmt->execute();
        $article->setId(DB::getPDO()->lastInsertId());
        return $result;
    }
}
