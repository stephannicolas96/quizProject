<?php

session_start();

include_once '../classes/path.php';
include_once path::getModelsPath() . 'user.php';
if (isset($_SESSION['lang'])) {
    include_once path::getLangagePath() . $_SESSION['lang'];
} else {
    exit;
}

$userInstance = new user;
$errors = array();
$success = false;

//EMAIL
if (!empty($_POST['login'])) {
    if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
        $userInstance->email = htmlspecialchars($_POST['login']);
        if (!$userInstance->getUserByEmail()) {
            $errors['login'] = EMAIL_ADDRESS_OR_PASSWORD_INCORRECT;
        }
    } else {
        $errors['login'] = EMAIL_ADDRESS_OR_PASSWORD_INCORRECT;
    }
} else {
    $errors['login'] = EMAIL_ADDRESS_OR_PASSWORD_INCORRECT;
}

//PASSWORD
if (!empty($_POST['loginPassword'])) {
    if (!password_verify($_POST['loginPassword'], $userInstance->password)) {
        $errors['login'] = EMAIL_ADDRESS_OR_PASSWORD_INCORRECT;
    }
} else {
    $errors['login'] = EMAIL_ADDRESS_OR_PASSWORD_INCORRECT;
}

if (count($errors) == 0) {
    $_SESSION['username'] = $userInstance->username;
    $_SESSION['email'] = $userInstance->email;
    $_SESSION['color'] = $userInstance->color;
    $_SESSION['id'] = $userInstance->id;
    $_SESSION['logged'] = true;
    $success = true;
}

echo json_encode(array('errors' => $errors, 'success' => $success));

session_write_close();
