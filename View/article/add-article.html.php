<div>
    <div class="titlePage">
        <h2>Ajoutez un article</h2>
    </div>


    <div id="formArticle">
        <form action=/index.php?c=article&a=add-article method="post">
            <div class="addA">
                <label for="title">Titre de l'article</label>
                <input type="text" name="title" id="title" placeholder="titre">
            </div>
            <div class="addA">
                <label for="">Contenue de votre article</label>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
            </div>
            <div class="addA">
                <label for="img">inseré une image/photo</label>
                <input type="file" id="img" name="img" >
            </div>
            <div id="divBut">
                <input type="submit" name="save" value="Enregistrer" id="enregistre">
            </div>
        </form>
    </div>
</div>
