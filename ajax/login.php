<?php
session_start();
include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';

$loginUserInstance = new user;
$loginErrors = array();
$hashedPassword = null;

//EMAIL
if (!empty($_POST['login'])) {
    if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
        $loginUserInstance->email = htmlspecialchars($_POST['login']);
        if (!$loginUserInstance->getUserByEmail()) {
            $loginErrors[] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
        } else {
            
        }
    } else {
        $loginErrors[] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
    }
} else {
    $loginErrors[] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
}

//PASSWORD
if (!empty($_POST['loginPassword'])) {
    $loginUserInstance->password = htmlspecialchars($_POST['loginPassword']);
    if (!password_verify($loginUserInstance->password, $databaseHashedPassword)) {
        $loginErrors[] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
    }
} else {
    $loginErrors[] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
}

if (count($loginErrors) == 0) {
    $_SESSION['username'] = $loginUserInstance->username;
    $_SESSION['email'] = $loginUserInstance->email;
    $_SESSION['image'] = $loginUserInstance->image;
    $_SESSION['color'] = $loginUserInstance->color;
    $_SESSION['id'] = $loginUserInstance->id;
    $_SESSION['logged'] = true;
    echo 1;
} else {
    echo implode('|', $loginErrors);
}
session_close();