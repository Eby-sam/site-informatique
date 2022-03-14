<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PC Rénove</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div id="container">
    <div>
        <div id="head">
            <div>LOGO</div>

            <div id="title">
                <h1>PC RENOVE</h1>
            </div>
        </div>

    </div>
    <div>
        <ul>
            <li>
                <a href="">Home</a>
            </li>
            <li>
                <a href="">Articles</a>
            </li><?php
            if(!UserController::isUserConnected()) { ?>
            <li>
                <a href="/index.php?c=article&a=add-article">FormArticle</a>
            </li>
                }
                else { ?>
                    <li><a href="/index.php?c=user&a=logout">Se déconnecter</a></li> <?php
                }
                ?>
            <li>
                <a href="">Galerie d'image</a>
            </li>
        </ul>
    </div>

    <?php

    echo "<pre>";
    var_dump([
        'user in session' => isset($_SESSION['user']),
        'user_connected' => UserController::isUserConnected(),
    ]);
    echo "</pre>";
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

</body>
</html>
