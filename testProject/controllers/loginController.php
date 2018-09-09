<?php

include_once path::getClassesPath() . 'user.php';

$loginUserInstance = new user;
$loginErrors = array();
$loginSuccess = false;

if (isset($_POST['signIn'])) {
    unset($_POST['signIn']);

    //EMAIL
    if (!empty($_POST['login'])) {
        if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            $loginUserInstance->email = htmlspecialchars($_POST['login']);
            if (!$loginUserInstance->getUserByEmail()) {
                $loginUserInstance->email = null;
                $loginErrors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
            }
        } else {
            $loginErrors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
        }
    }

    //PASSWORD
    if (!empty($_POST['loginPassword']) ) {
        $loginUserInstance->password = htmlspecialchars($_POST['loginPassword']);
        if (!password_verify($loginUserInstance->password, $loginUserInstance->databaseHashedPassword)) {
            $loginErrors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
        }
    }

    if (count($loginErrors) == 0) {
        $_SESSION['username'] = $loginUserInstance->username;
        $_SESSION['email'] = $loginUserInstance->email;
        $_SESSION['image'] = $loginUserInstance->image;
        $_SESSION['color'] = $loginUserInstance->color;
        $_SESSION['id'] = $loginUserInstance->id;
        $_SESSION['logged'] = true;
        $loginSuccess = true;
        $loginUserInstance->email = null;
    }
}