<?php
include_once path::getControllersPath() . 'header.php';
if (!empty($controllerToLoad)) {
    include_once path::getControllersPath() . $controllerToLoad;
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
    <head>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pizza/0.2.1/css/pizza.min.css" />
        <link rel="stylesheet" href="../assets/css/style.css" />
        <title><?= $pageTitle ?> - BATTLELY</title>
    </head>
    <body id="<?= $pageBackground ?>">
        <?php
        include path::getLayoutPath() . 'modalLogin.php';
        include path::getLayoutPath() . 'modalRegistration.php';
        include path::getLayoutPath() . 'modalDuelSelection.php'
        ?>
        <div class="navbar-fixed">
            <nav class="navbar">
                <div class="nav-wrapper">
                    <a href="accueil.html" class="brand-logo"><img class="logo" src="../assets/images/logo.png" /></a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a class="modal-trigger" href="#duelCreation"><?= DUEL ?></a></li> 
                        <li><a href="createBattle.html"><?= CREATE ?></a></li>
                        <li><a href="leaderboard-1.html"><?= LEADERBOARD ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger left" href="#registrationModal"><?= SIGN_UP ?></a>
                            /
                            <a class="modal-trigger right" href="#loginModal"><?= LOG_IN ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a class="left" href="profile.html"><?= MY_ACCOUNT ?></a>
                            /
                            <a class="right" href="logout.html"><?= LOGOUT ?></a>
                        </li>
                        <li>
                            <a href="javascript:tarteaucitron.userInterface.openPanel();">Gestion des cookies</a>
                        </li>
                        <li>
                            <button onclick="openDropdown('#langageDropdown')" class="nav-link"><img src="../assets/images/<?= $lang ?>.png" /></button>
                        </li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="leaderboard-1.html"><?= LEADERBOARD ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger" href="#registrationModal"><?= SIGN_UP ?></a>
                        </li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger" href="#loginModal"><?= LOG_IN ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a href="profile.html"><?= MY_ACCOUNT ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a href="logout.html"><?= LOGOUT ?></a>
                        </li>
                        <li>
                            <a href="javascript:tarteaucitron.userInterface.openPanel();">Gestion des cookies</a>
                        </li>
                        <li>
                            <button onclick="openDropdown('#langageDropdown')"><img src="../assets/images/<?= $lang ?>.png" /></button>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div id="langageDropdown" class="dropdown">
            <div class="top"></div>
            <div class="content">
                <a href="../en/<?= $urlEnd ?>">english<img src="../assets/images/en.png" /></a>
                <a href="../fr/<?= $urlEnd ?>">français<img src="../assets/images/fr.png" /></a>
            </div>
            <div class="bottom"></div>
        </div>