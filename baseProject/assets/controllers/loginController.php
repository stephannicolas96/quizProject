<?php

include_once path::getClasses() . 'user.php';

$loginUserInstance = new user();

$loginSuccess = false;
$loginErrors = array();
$previousLogin = null;

if (!empty($_POST) && isset($_POST['connect'])) {

    $loginError = true;

    //MAIL/USERNAME
    if (isset($_POST['login'])) {

        $login = htmlspecialchars($_POST['login']);
        $loginUserInstance->mail = $loginUserInstance->username = $login;

        if ((!preg_match(regex::getUsername(), $loginUserInstance->username) || empty($loginUserInstance->username)) && (!preg_match(regex::getMail(), $loginUserInstance->mail) || empty($loginUserInstance->mail))) {
            $loginError = true;
        } else if ($loginUserInstance->getUserByMail() == 1 || $loginUserInstance->getUserByUsername() == 1) {
            $loginError = false;
            $previousLogin = $loginUserInstance->username;
        }
    }

    //PASSWORD
    if (isset($_POST['password'])) {

        $loginUserInstance->password = htmlspecialchars($_POST['password']);
        if (!preg_match(regex::getPassword(), $loginUserInstance->password) || empty($loginUserInstance->password)) {
            $loginError = true;
        } else {
             if (!password_verify($loginUserInstance->password, $loginUserInstance->hashedPassword)) {
                $loginError = true;
            }
        }
    }

    if ($loginError) {
        $loginErrors['connexion'] = 'Mail/Nom d\'utilisateur ou mot de passe incorrecte';
    }

    if (count($loginErrors) == 0) {
        $_SESSION['username'] = $loginUserInstance->username;
        $_SESSION['mail'] = $loginUserInstance->mail;
        $_SESSION['image'] = $loginUserInstance->image;
        $_SESSION['color'] = $loginUserInstance->color;
        $_SESSION['id'] = $loginUserInstance->id;
        $_SESSION['logged'] = true;
        $loginSuccess = true;
        unset($_POST);
    }
}
