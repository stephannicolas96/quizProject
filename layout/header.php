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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <link rel="stylesheet" href="../assets/css/style.css" />
        <title><?= $pageTitle ?> - BATTLELY</title>
        <script src="../assets/js/import/tarteaucitron/tarteaucitron.js"></script>
        <script>
            tarteaucitron.init({
                "privacyUrl": "", /* Privacy policy url */

                "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
                "cookieName": "tartaucitron", /* Cookie name */

                "orientation": "top", /* Banner position (top - bottom) */
                "showAlertSmall": false, /* Show the small banner on bottom right */
                "cookieslist": true, /* Show the cookie list */

                "adblocker": false, /* Show a Warning if an adblocker is detected */
                "AcceptAllCta": true, /* Show the accept all button when highPrivacy on */
                "highPrivacy": false, /* Disable auto consent */
                "handleBrowserDNTRequest": false, /* If Do Not Track == 1, accept all */

                "removeCredit": false, /* Remove credit link */
                "moreInfoLink": true, /* Show more info link */

                //"cookieDomain": ".my-multisite-domaine.fr" /* Shared cookie for subdomain */
            });
            (tarteaucitron.job = tarteaucitron.job || []).push('recaptcha');
        </script>
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
                        <li><a class="modal-trigger" href="#duelCreation"><?= defined('DUEL') ? DUEL : 'duel' ?></a></li> 
                        <li><a href="createBattle.html"><?= defined('CREATE') ? CREATE : 'create' ?></a></li>
                        <li><a href="leaderboard.html"><?= defined('LEADERBOARD') ? LEADERBOARD : 'leaderboard' ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger left" href="#registrationModal"><?= defined('SIGN_UP') ? SIGN_UP : 'sign Up' ?></a>
                            /
                            <a class="modal-trigger right" href="#loginModal"><?= defined('LOG_IN') ? LOG_IN : 'login' ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a class="left" href="profile.html"><?= defined('MY_ACCOUNT') ? MY_ACCOUNT : 'my account' ?></a>
                            /
                            <a class="right" href="logout.html"><?= defined('LOGOUT') ? LOGOUT : 'logout' ?></a>
                        </li>
                        <li>
                            <a href="javascript:tarteaucitron.userInterface.openPanel();">Gestion des cookies</a>
                        </li>
                        <li>
                            <button onclick="openDropdown('#langageDropdown')" class="nav-link"><img src="../assets/images/<?= $lang ?>.png" /></button>
                        </li>
                    </ul>
                    <ul class="side-nav" id="mobile-demo">
                        <li><a href="leaderboard.html"><?= defined('LEADERBOARD') ? LEADERBOARD : 'leaderboard' ?></a></li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger" href="#registrationModal"><?= defined('SIGN_UP') ? SIGN_UP : 'sign Up' ?></a>
                        </li>
                        <li class="notLogged" style="<?= (!$isLogged) ? '' : 'display:none;' ?>">
                            <a class="modal-trigger" href="#loginModal"><?= defined('LOG_IN') ? LOG_IN : 'login' ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a href="profile.html"><?= defined('MY_ACCOUNT') ? MY_ACCOUNT : 'my account' ?></a>
                        </li>
                        <li class="logged" style="<?= ($isLogged) ? '' : 'display:none;' ?>">
                            <a href="logout.html"><?= defined('LOGOUT') ? LOGOUT : 'logout' ?></a>
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