<?php
session_start();
include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';

$userInstance = new user;
$errors = array();
$hashedPassword = null;

//EMAIL
if (!empty($_POST['login'])) {
    if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
        $userInstance->email = htmlspecialchars($_POST['login']);
        $user = $userInstance->getUserByEmail();
        if (!is_object($user)) {
            $errors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
        } else {
            $hashedPassword = $user->password;
            $userInstance->username = $user->username;
            $userInstance->color = $user->color;
            $userInstance->id = $user->id;
        }
    } else {
        $errors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
    }
} else {
    $errors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
}

//PASSWORD
if (!empty($_POST['password'])) {
    $userInstance->password = htmlspecialchars($_POST['password']);
    if (!password_verify($userInstance->password, $hashedPassword)) {
        $errors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
    }
} else {
    $errors['login'] = 'adresse e-mail ou mot de passe incorrecte'; // TODO USE TRAD
}

if (count($errors) == 0) {
    $_SESSION['username'] = $userInstance->username;
    $_SESSION['email'] = $userInstance->email;
    $_SESSION['color'] = $userInstance->color;
    $_SESSION['id'] = $userInstance->id;
    $_SESSION['logged'] = true;
    echo 1;
} else {
    echo implode('|', $errors);
}
session_write_close();