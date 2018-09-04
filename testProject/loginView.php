<?php
session_start();
include_once 'assets/classes/path.php'; //TEMP REMOVE
include path::getLangagePath() . 'fr_FR.php'; //TEMP REMOVE
include_once path::getControllersPath() . 'loginController.php';
?>
<form action="#" method="POST">
    <button type="button">&times;</button>

    <h1><?= defined('logIn') ? logIn : 'Log In' ?></h1>   

    <label for="login"><?= defined('emailOrUsername') ? emailOrUsername : 'Log In' ?></label>
    <input id="login" type="text" placeholder="<?= defined('emailOrUsernamePlaceholder') ? emailOrUsernamePlaceholder : 'Enter an email or an username' ?>" name="login" value="<?= ($savedLogin) ? $savedLogin : '' ?>" required />

    <label for="password"><?= defined('password') ? password : 'Password' ?></label>
    <input id="password" type="password" placeholder="<?= defined('passwordPlaceholder') ? passwordPlaceholder : 'Enter a password' ?>" name="password" required />

    <?php
    if (!$loginSuccess) { // login failed show all error messages
        foreach ($loginErrors as $errorMessage) {
            ?>
            <p><?= $errorMessage ?></p>
            <?php
        }
    } else { // show a successful login message
        ?>        
        <p><?= defined('successfulLogin') ? successfulLogin : 'Login sucessful !' ?></p>   
    <?php } ?>
    <input type="submit" name="signIn" value="<?= defined('signIn') ? signIn : 'Sign in' ?>" />
    <p><?= defined('noAccount') ? noAccount : 'No account?' ?><a href="registrationView.php"><?= defined('createOne') ? createOne : 'Create one!' ?></a></p>
    <a href="logoutView.php"><?= defined('forgotPassword') ? forgotPassword : 'Forgot your password?' ?></a>
</form>
