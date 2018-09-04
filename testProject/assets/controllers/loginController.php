<?php

include_once path::getClassesPath() . 'user.php';

$loginUserInstance = new user;
$loginSuccess = false;
$loginErrors = array();

$savedLogin = null;

if (isset($_POST['signIn'])) {
    unset($_POST['signIn']);

    //MAIL/USERNAME
    if (!empty($_POST['login'])) {
        if (preg_match(regex::getMailRegex(), $_POST['login'])) {
                $loginUserInstance->mail = $_POST['login'];
            if ($loginUserInstance->getUserByMail()) {
                $savedLogin = htmlspecialchars($loginUserInstance->mail);
            } else {
                $loginUserInstance->mail = null;
                $loginErrors['login'] = 'Mail/Nom d\'utilisateur ou mot de passe incorrecte';
            }
        } else if (preg_match(regex::getUsernameRegex(), $_POST['login'])) {
                $loginUserInstance->username = $_POST['login'];
            if ($loginUserInstance->getUserByUsername()) {
                $savedLogin = htmlspecialchars($loginUserInstance->username);
            } else {
                $loginUserInstance->username = null;
                $loginErrors['login'] = 'Mail/Nom d\'utilisateur ou mot de passe incorrecte';
            }
        } else {
            $loginErrors['login'] = 'Mail/Nom d\'utilisateur ou mot de passe incorrecte';
        }
    }
    unset($_POST['login']);


    //PASSWORD
    if (!empty($_POST['password'])) {
        if (preg_match(regex::getPasswordRegex(), $_POST['password'])) {
            $loginUserInstance->password = $_POST['password'];
            if (!password_verify($loginUserInstance->password, $loginUserInstance->databaseHashedPassword)) {
                $loginErrors['password'] = 'password incorrecte';
            }
        } else {
            $loginErrors['password'] = 'password incorrecte';
        }
    }
    unset($_POST['password']);

    if (count($loginErrors) == 0) {
        $_SESSION['username'] = $loginUserInstance->username;
        $_SESSION['mail'] = $loginUserInstance->mail;
        $_SESSION['image'] = $loginUserInstance->image;
        $_SESSION['color'] = $loginUserInstance->color;
        $_SESSION['id'] = $loginUserInstance->id;
        $_SESSION['logged'] = true;
        $loginSuccess = true;
        $savedLogin = null;
    }
}

if(isset($_SESSION['logged'])){
    header('Location: index.php');
}