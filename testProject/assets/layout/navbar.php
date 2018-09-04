<?php include_once path::getControllersPath() . 'navbarController.php'; ?>
<nav>
    <a href="/"></a>
    <ul>
        <li><a href="duelView.php"><?= defined('duel') ? duel : 'duel' ?></a></li>
        <li><a href="quizCreation.php"><?= defined('create') ? create : 'create' ?></a></li>
        <li><a href="leaderboard.php"><?= defined('leaderboard') ? leaderboard : 'leaderboard' ?></a></li>
        <?php if (!$isLogged) { ?>
            <li><a href="registrationView.php"><?= defined('signUp') ? signUp : 'sign Up' ?></a></li>
        <?php } ?>
    </ul>
</nav>
<ul>
    <li>
        <a href="#"><?= defined('langage') ? langage : 'langage' ?></a>
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
            <a href="loginView.php"><?= defined('login') ? login : 'login' ?></a>
        </li>
    <?php } ?>
</ul>