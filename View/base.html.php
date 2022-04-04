<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC Rénov</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php
    if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0){
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        foreach ($errors as $error) { ?>
            <div>
                <?php
                    $error
                ?>
            </div><?php


        }
    }
?>

<?php
if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
    unset($_SESSION['success']);

    ?><div>
        <?php $success?>
        </div><?php
}
?>
<div id="container">
    <div>
        <div id="head">
            <div>LOGO</div>

            <div id="titre">
                <h1>PC RENOV</h1>
            </div>
        </div>

    </div>
    <div>
        <ul class="liste">
            <li>
                <a href="/index.php?c=home&a=Home">Home</a>
            </li>
            <li>
                <a href="/index.php?c=article&a=articles">Articles</a>
            </li>

            <?php
            if(UserController::isUserConnected()) { ?>
            <li>
                <a href="/index.php?c=article">FormArticle</a>

            </li>
            <li>
                <a href="/index.php?c=user&a=logout">Déconnexion</a>
            </li><?php
            }
            else { ?>
             <?php
            } ?>
        </ul>
    </div>

    <?php

    // Handling error messages.
    if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        foreach($errors as $error) { ?>
            <div class="alert alert-error"><?= $error ?></div> <?php
        }
    }

    // Handling sucecss messages.
    if(isset($_SESSION['success'])) {
        $message = $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
        <div class="alert alert-success"><?= $message ?></div> <?php
    }
    ?>


</div>

<main class="container">
    <?= $html ?>
</main>
<div class="container2">
    <div>
        <table>

        </table>
    </div>
</div>


<footer>
    <div id="footer">
        <div class="footer1">
            <p class="foot">
                adresse : 9 la Ville Armel
            </p>
            <p class="foot">
                code Postal : 56800 Taupont
            </p>
        </div>
        <div class="footer1">
            <p class="foot">
                telephone : 06 50 41 77 28
            </p>
            <p class="foot">
                email : pc.renov56@gmail.com
            </p>
        </div>


    </div>
</footer>

<script src="/assets/js/app.js"></script>
</body>
</html>
