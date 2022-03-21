<?php
use App\Config;
use App\Model\DB;
use App\Model\Entity\Article;
use App\Model\Manager\ArticleManager;
?>

<div class="titlePage">
    <h2>Liste des Articles</h2>
</div>
<div id="articles">
    <?php


    $articleManager = new ArticleManager();

    $articles = $articleManager->findAll();

    foreach($articles as $key => $article) { ?>
        <div class="article">
            <div class="articleTitle">
                <h3><?= $article->getTitle() ?></h3>
                <p><?= $article->getContent() ?></p>
            </div>
        </div>
        <?php
    } ?>
</div>



