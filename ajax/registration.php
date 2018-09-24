<?php
session_start();
include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';
include_once path::getLangagePath() . $_SESSION['lang'];

$userInstance = new user();
$errors = array();
$usernameAlreadyExist = null;
$mailAlreadyExist = null;
$hashedPassword = null;

//USERNAME
if (!empty($_POST['username'])) {
    $userInstance->username = htmlspecialchars($_POST['username']);
    $usernameAlreadyExist = $userInstance->checkIfUsernameAlreadyExist();
    if ($usernameAlreadyExist) {
        $errors['username'] = defined('usernameAlreadyUsed') ? usernameAlreadyUsed : 'Username already used';
    }
} else {
    $errors['username'] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
}

//EMAIL
if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $userInstance->email = htmlspecialchars($_POST['email']);
        $mailAlreadyExist = $userInstance->checkIfEmailAlreadyExist();
        if ($mailAlreadyExist) {
            $errors['email'] = defined('emailAlreadyUsed') ? emailAlreadyUsed : 'Email already used';
        }
    } else {
        $errors['email'] = defined('emailIncorrect') ? emailIncorrect : 'Email incorrect';
    }
} else {
    $errors['email'] = defined('emailEmpty') ? emailEmpty : 'Email can\'t be empty';
}

//PASSWORD
if (!empty($_POST['password'])) {
    $userInstance->password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
} else {
    $errors['password'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
}

if (count($errors) == 0) {
    if (!$mailAlreadyExist && !$usernameAlreadyExist) {
        if ($userInstance->addUser()) {
            echo 1;
        } else {
            echo defined('registrationFailed') ? registrationFailed : 'Registration failed! Please try again later.';
        }
    }
} else {
    echo implode('|', $errors);
}
session_write_close();