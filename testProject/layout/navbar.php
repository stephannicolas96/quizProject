<?php
include path::getLayoutPath() . 'loginView.php';
include path::getLayoutPath() . 'registrationView.php';
include_once path::getControllersPath() . 'navbarController.php';
include_once path::getControllersPath() . 'logoutController.php';
?>
<nav>
    <nav>
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Logo</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="duelView.php"><?= defined('duel') ? duel : 'duel' ?></a></li> 
                <li><a href="creationView.php"><?= defined('create') ? create : 'create' ?></a></li>
                <li><a href="leaderboard.php"><?= defined('leaderboard') ? leaderboard : 'leaderboard' ?></a></li>
                <?php if (!$isLogged) { ?>
                    <li><a class="modal-trigger" href="#registrationModal"><?= defined('signUp') ? signUp : 'sign Up' ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</nav>
<ul>
    <li>
        <a href="#">TEMP REPLACE WITH CURRENT LANGAGE FLAG</a>
        <ul>
            <li><a href="?lang=en">english</a></li>
            <li><a href="?lang=fr">français</a></li>
        </ul>
    </li>
    <?php if ($isLogged) { ?>
        <li>
            <a href="profileView.php"><?= defined('myAccount') ? myAccount : 'my account' ?></a>
            <a href="?logout"><?= defined('logout') ? logout : 'logout' ?></a>
        </li>
    <?php } else { ?>
        <li>
            <a class="waves-effect waves-light btn modal-trigger" href="#loginModal"><?= defined('logIn') ? logIn : 'login' ?></a>
        </li>
    <?php } ?>
</ul>
<?php
?>