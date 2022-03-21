<div id="homeContainer">
    <div class="titlePage">
        <h2> PC RENOV (HOME) </h2>

        <h3>Réparation d'ordinateurs et matérielles informatiques</h3>
    </div>

    <div id="home">

        <?php


        use App\Model\Manager\ArticleManager;

        $articleManager = new ArticleManager();

        $articles = $articleManager->getArticles();

        foreach($articles as $key => $article) { ?>

                <div class="divImg">
                    <img src="" alt="" height="80%" width="100%">
                    <h3><?= $article->getTitle() ?></h3>
                </div>

            <?php
        } ?>

    </div>

</div>


