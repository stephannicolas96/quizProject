<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';

$registrationUserInstance = new user();
$registrationErrors = array();
$registrationSuccess = false;
$usernameAlreadyExist = null;
$mailAlreadyExist = null;

//USERNAME
if (!empty($_POST['username'])) {
    $registrationUserInstance->username = htmlspecialchars($_POST['username']);
    $usernameAlreadyExist = $registrationUserInstance->checkIfUsernameAlreadyExist();
    if ($mailAlreadyExist && !isset($registrationErrors['email'])) {
        $registrationErrors[] = defined('emailAlreadyUsed') ? emailAlreadyUsed : 'Email already used';
    }
} else {
    $registrationErrors[] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
}

//EMAIL
if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $registrationUserInstance->email = htmlspecialchars($_POST['email']);
        $mailAlreadyExist = $registrationUserInstance->checkIfEmailAlreadyExist();
        if ($usernameAlreadyExist && !isset($registrationErrors['username'])) {
            $registrationErrors[] = defined('usernameAlreadyUsed') ? usernameAlreadyUsed : 'Username Already Used';
        }
    } else {
        $registrationErrors[] = defined('emailIncorrect') ? emailIncorrect : 'Email incorrect';
    }
} else {
    $registrationErrors[] = defined('emailEmpty') ? emailEmpty : 'Email can\'t be empty';
}

//PASSWORD
if (!empty($_POST['registrationPassword'])) {
    $registrationUserInstance->password = htmlspecialchars($_POST['registrationPassword']);
    $registrationUserInstance->hashedPassword = password_hash($registrationUserInstance->password, PASSWORD_BCRYPT);
} else {
    $registrationErrors[] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
}

if (count($registrationErrors) == 0) {
    if (!$mailAlreadyExist && !$usernameAlreadyExist) {
        if ($registrationUserInstance->addUser()) {
            echo 1;
        } else {
            echo defined('registrationFailed') ? registrationFailed : 'Registration failed! Please try again later.';
        }
    }
} else {
    echo implode('|', $registrationErrors);
}