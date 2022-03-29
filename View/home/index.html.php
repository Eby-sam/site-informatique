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

                <div class="divArticleH">
                    <div class="contain1">
                        <h3><?= $article->getTitle() ?></h3>
                    </div>

                    <div class="contain2">
                        <h4><?= $article->getContent() ?></h4>
                    </div>
                </div>
            <?php
        } ?>

    </div>

    <div id="divHoraire">
        <div class="horaire one">
            <p>
                Pour vous offrir un meilleur service voici la liste des horaires d'ouverture et fermeture =>
            </p>

        </div>
        <div class="horaire two">
            <h3>Horaires d'ouverture/fermeture</h3>
            <br>
            <div class="tree">
                <ul id="listeHome">
                    <li>Mardi : 9h 12h30 et 14h 18h30</li>
                    <li>Mercredi : 9h 12h30 et 14h 18h30</li>
                    <li>Jeudi : 9h 12h30 et 14h 18h30</li>
                    <li>Vendredi : 9h 12h30 et 14h 18h30</li>
                    <li>Samedi : 9h 12h30 et 14h 18h30</li>
                </ul>
            </div>


        </div>
    </div>

    <div class="imgHome">
    </div>

</div>


