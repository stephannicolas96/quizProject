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
        <link rel="icon" type="image/png" href="../assets/images/logo">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pizza/0.2.1/css/pizza.min.css" />
        <link rel="stylesheet" href="../assets/css/style.css" />
        <title>Battlely - <?= $pageTitle ?></title>
    </head>
    <body>
        <?php
        include path::getLayoutPath() . 'modalLogin.php';
        include path::getLayoutPath() . 'modalRegistration.php';
        include path::getLayoutPath() . 'modalDuelSelection.php'
        ?>
        <header>
            <div class="navbar-fixed">
                <nav class="navbar">
                    <div class="nav-wrapper">
                        <a href="home" class="brand-logo"><img class="logo" src="../assets/images/logo"/></a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <?php if ($isLogged) { ?>
                                <li><a class="modal-trigger" href="#duelCreation"><?= BATTLE ?></a></li> 
                                <li><a href="createBattle"><?= CREATE ?></a></li>
                            <?php } ?>
                            <li><a href="leaderboard-1"><?= LEADERBOARD ?></a></li>
                            <?php if (!$isLogged) { ?>
                                <li>
                                    <a class="modal-trigger left" href="#registrationModal"><?= SIGN_UP ?></a>
                                    /
                                    <a class="modal-trigger right" href="#loginModal"><?= LOG_IN ?></a>
                                </li>
                                <?php
                            }
                            if ($isLogged) {
                                ?>
                                <li>
                                    <a class="left" href="profile"><?= MY_ACCOUNT ?></a>
                                    /
                                    <a class="right" href="logout"><?= LOGOUT ?></a>
                                </li>
                            <?php } ?>
                            <li><button class="btn-clear" onclick="openDropdown('#langageDropdown')"><img src="../assets/images/<?= $lang ?>" /></button></li>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">
                            <?php if ($isLogged) { ?>
                                <li><a class="modal-trigger" href="#duelCreation"><?= BATTLE ?></a></li> 
                                <li><a href="createBattle"><?= CREATE ?></a></li>
                            <?php } ?>
                            <li><a href="leaderboard-1"><?= LEADERBOARD ?></a></li>
                            <?php if (!$isLogged) { ?>
                                <li><a class="modal-trigger" href="#registrationModal"><?= SIGN_UP ?></a></li>
                                <li><a class="modal-trigger" href="#loginModal"><?= LOG_IN ?></a></li>
                                <?php
                            }
                            if ($isLogged) {
                                ?>
                                <li><a href="profile"><?= MY_ACCOUNT ?></a></li>
                                <li><a href="logout"><?= LOGOUT ?></a></li>
                            <?php } ?>
                            <li><a href="../en/<?= $urlEnd ?>">English</a>/<a href="../fr/<?= $urlEnd ?>">Français</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div id="langageDropdown" class="dropdown">
                <div class="top"></div>
                <div class="content">
                    <a href="../en/<?= $urlEnd ?>">English<img src="../assets/images/en" /></a>
                    <a href="../fr/<?= $urlEnd ?>">Français<img src="../assets/images/fr" /></a>
                </div>
                <div class="bottom"></div>
            </div>
        </header>
        <main>