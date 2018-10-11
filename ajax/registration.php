<?php

session_start();
include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';
include_once path::getLangagePath() . $_SESSION['lang'];

$userInstance = new user();
$errors = array();
$success = false;
$usernameAlreadyExist = null;
$mailAlreadyExist = null;
$hashedPassword = null;

//USERNAME
if (!empty($_POST['username'])) {
    $userInstance->username = htmlspecialchars($_POST['username']);
    if (strlen($userInstance->username) <= 60) {
        $usernameAlreadyExist = $userInstance->checkIfUsernameAlreadyExist();
        if ($usernameAlreadyExist) {
            $errors['username'] = USERNAME_ALREADY_USED;
        }
    }
} else {
    $errors['username'] = USERNAME_EMPTY;
}

//EMAIL
if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $userInstance->email = htmlspecialchars($_POST['email']);
        if (strlen($userInstance->email) <= 60) {
            $mailAlreadyExist = $userInstance->checkIfEmailAlreadyExist();
            if ($mailAlreadyExist) {
                $errors['email'] = EMAIL_ALREADY_USED;
            }
        }
    } else {
        $errors['email'] = EMAIL_INCORRECT;
    }
} else {
    $errors['email'] = EMAIL_EMPTY;
}

//PASSWORD
if (!empty($_POST['password'])) {
    $password = htmlspecialchars($_POST['password']);
    if (strlen($password) <= 60) {
        $userInstance->password = password_hash($password, PASSWORD_BCRYPT);
    }
} else {
    $errors[] = EMPTY_PASSWORD;
}

if (count($errors) == 0) {
    if (!$mailAlreadyExist && !$usernameAlreadyExist) {
        if ($userInstance->addUser()) {
            $success = true;
        } else {
            $errors[] = REGISTRATION_FAILED;
        }
    }
}

echo json_encode(array('errors' => $errors, 'success' => $success));

session_write_close();
