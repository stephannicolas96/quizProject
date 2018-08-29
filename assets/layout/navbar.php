<?php
include path::getLayout() . 'modalLogin.php';
include path::getLayout() . 'modalRegistration.php';
include path::getLayout() . 'modalForgotPassword.php';
include path::getLayout() . 'modalLogout.php';

$isLoggedSet = isset($_SESSION['logged']);
?>

<nav>
    <a href="/" id="headerLogo"><img src="" alt="LOGO" width="140"></a>
    <ul>
        <li><a href="" class="highlighted"><?= (defined('duel')) ? duel : 'Duel' ?></a></li>
        <li><a href="quizCreation.php" class="highlighted"><?= (defined('create')) ? create : 'Create' ?></a></li>
        <li><a href="leaderboardView.php" class="highlighted"><?= (defined('leaderboard')) ? leaderboard : 'Leaderboard' ?></a></li>
        <li id="SignUp"><a href="" class="highlighted"><?= (defined('signUp')) ? signUp : 'Sign Up' ?></a></li>
    </ul>
    <div class="close"></div>
</nav>
<ul id="settingsMenu">
    <?php if (!empty($lang)) { ?>
        <li>
            <a href="#" class="highlighted"><img src="assets/images/<?= $lang ?>.png" /></a>
            <ul>
                <li>
                    <p><a href="" class="highlighted <?= ($lang == 'en') ? 'active' : '' ?>"><img src="assets/images/en.png" />English</a></p>
                </li>
                <li>
                    <p><a href="" class="highlighted <?= ($lang == 'fr') ? 'active' : '' ?>" ><img src="assets/images/fr.png" />Français</a></p>
                </li>
            </ul>
        </li>
    <?php } if ($isLoggedSet) { ?>
        <li>
            <p>
                <a href="" class="highlighted"><img src="assets/images/my-account-.png" /><?= (defined('profile')) ? profile : 'My Account' ?></a> |                  
                <a href="" class="highlighted"><?= (defined('logout')) ? logout : 'Log Out' ?></a>
            </p>
        </li>
    <?php } else { ?>
        <li>
            <p><a href="" class="highlighted"><img src="assets/images/my-account.png" /><?= (defined('logIn')) ? logIn : 'Log In' ?></a></p>
        </li>
    <?php } ?>
</ul>