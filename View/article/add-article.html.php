<div class="titlePage">
    <h2>Ajoutez un article</h2>
</div>


<div id="formArticle">
    <form action=/index.php?c=article&a=add-article"" method="post">
        <div>
            <label for="title">Titre de l'article</label>
            <input type="text" name="title" id="title" placeholder="titre">
        </div>
        <div>
            <label for=""></label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" name="save" value="Enregistrer">
    </form>
</div>