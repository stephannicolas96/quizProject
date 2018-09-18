<?php
session_start();
include_once 'assets/classes/path.php';
include path::getLangagePath() . 'fr_FR.php'; //TEMP REMOVE
include_once path::getControllersPath() . 'registrationController.php';
?>
<form action="#" method="POST">
    <label for="username" ><?= (defined('username')) ? username : 'Username' ?></label>
    <input id="username" type="text" placeholder="<?= (defined('usernamePlaceholder')) ? usernamePlaceholder : 'Enter a username' ?>" name="username" value="<?= 'CHANGE' ?>" required />
    <label for="mail"><?= (defined('mail')) ? mail : 'Mail' ?></label>
    <input id="mail" type="text" placeholder="<?= (defined('mailPlaceholder')) ? mailPlaceholder : 'Enter a mail' ?>" name="mail" value="<?= 'CHANGE' ?>" required />
    <label for="password"><?= (defined('password')) ? password : 'Password' ?></label>
    <input id="password" type="password" placeholder="<?= (defined('passwordPlaceholder')) ? passwordPlaceholder : 'Enter a password' ?>" name="password" required />
    <label for="confirmPassword"><?= (defined('passwordRepeat')) ? passwordRepeat : 'Repeat password' ?></label>
    <input id="confirmPassword" type="password" placeholder="<?= (defined('passwordPlaceholder')) ? passwordPlaceholder : 'Enter a password' ?>" name="confirmPassword" required />      
    <?php
    if (!$registrationSuccess) {
        foreach ($registrationErrors as $errorMessage) {
            ?>
            <p><?= $errorMessage ?></p>
            <?php
        }
    } else {
        ?>
        <p><?= (defined('successfulRegistration')) ? successfulRegistration : 'Registration sucessful, you can try to connect yourself !' ?></p>   
    <?php } ?>
        <p><?= (defined('byCreatingAnAccount')) ? byCreatingAnAccount : 'By creating an account you agree to our' ?><a href="#"><?= (defined('termsAndPrivacy')) ? termsAndPrivacy : 'Terms & Privacy' ?></a>.</p>
        <input type="submit" name="register" value="<?= (defined('register')) ? register : 'Register' ?>" />
        <p><?= (defined('alreadyHaveAnAccount')) ? alreadyHaveAnAccount : 'Already have an account?' ?><a href="#"><?= (defined('signIn')) ? signIn : 'Sign in' ?></a>.</p>
</form>
