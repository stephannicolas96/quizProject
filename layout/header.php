    <?php
    include_once path::getControllersPath() . 'header.php';
    ?>
    <!DOCTYPE html>
    <html lang="<?= $lang ?>">
        <head>      
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <meta name="author" content="Stephan Nicolas" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
            <link rel="stylesheet" href="<?= $_SERVER['PHP_SELF'] != '/index.php' ? '../../' : '../' ?>assets/js/import/codeMirror/lib/codemirror.css" />
            <link rel="stylesheet" href="<?= $_SERVER['PHP_SELF'] != '/index.php' ? '../../' : '../' ?>assets/js/import/codeMirror/theme/monokai.css" />
            <link rel="stylesheet" href="<?= $_SERVER['PHP_SELF'] != '/index.php' ? '../../' : '../' ?>assets/css/style.css" />
            <?= $_SERVER['PHP_SELF'] ?>
            <title><?= $pageTitle ?> - BATTLELY</title>
        </head>
        <body id="<?= $pageBackground ?>">
            <?php
            include path::getLayoutPath() . 'modalLogin.php';
            include path::getLayoutPath() . 'modalRegistration.php';
            ?>
            <nav>
                <div class="nav-wrapper">
                    <a href="index.php" class="brand-logo"><img class="logo" src="../assets/images/logo.png" /></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="<?= $lang ?>/battle.html"><?= defined('duel') ? duel : 'duel' ?></a></li> 
                        <li><a href="<?= $lang ?>/createBattle.html"><?= defined('create') ? create : 'create' ?></a></li>
                        <li><a href="<?= $lang ?>/leaderboard.html"><?= defined('leaderboard') ? leaderboard : 'leaderboard' ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger left" href="#registrationModal"><?= defined('signUp') ? signUp : 'sign Up' ?></a>
                            /
                            <a class="modal-trigger right" href="#loginModal"><?= defined('logIn') ? logIn : 'login' ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a class="left" href="views/profile.php"><?= defined('myAccount') ? myAccount : 'my account' ?></a>
                            /
                            <a class="right" href="logout.html"><?= defined('logout') ? logout : 'logout' ?></a>
                        </li>
                        <li class="languageSelector">
                            <a href="#"><img src="../assets/images/<?= $lang ?>.png" /></a>
                            <div>
                                <a href="?lang=en">english<img src="../assets/images/en.png" /></a>
                                <a href="?lang=fr">français<img src="../assets/images/fr.png" /></a>
                            </div>
                        </li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="duelView.php"><?= defined('duel') ? duel : 'duel' ?></a></li> 
                        <li><a href="creationView.php"><?= defined('create') ? create : 'create' ?></a></li>
                        <li><a href="leaderboard.php"><?= defined('leaderboard') ? leaderboard : 'leaderboard' ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger left" href="#registrationModal"><?= defined('signUp') ? signUp : 'sign Up' ?></a>
                            /
                            <a class="modal-trigger right" href="#loginModal"><?= defined('logIn') ? logIn : 'login' ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a class="left" href="views/profile.php"><?= defined('myAccount') ? myAccount : 'my account' ?></a>
                            /
                            <a class="right" href="logout.html"><?= defined('logout') ? logout : 'logout' ?></a>
                        </li>
                        <li class="languageSelector">
                            <a href=""><img src="../assets/images/<?= $lang ?>.png" /></a>
                            <ul>
                                <li><a href="?lang=en"><img src="../assets/images/en.png">english</a></li>
                                <li><a href="?lang=fr"><img src="../assets/images/fr.png">français</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>