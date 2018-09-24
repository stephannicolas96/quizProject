<?php

session_start();

include_once path::getClassesPath() . 'user.php';

$userInstance = new user();

$modifying = false;
$canModify = false;
$isLogged = (isset($_SESSION['logged'])) ? $_SESSION['logged'] : false;
$sessionId = (isset($_SESSION['id'])) ? $_SESSION['id'] : -1;
$userImageExist = false;

if (isset($_GET['id']) && preg_match(regex::getIdRegex(), $_GET['id'])) {
    $urlId = $_GET['id'];
    if ($urlId == $sessionId) {
        $canModify = true;
    }
} else {
    if ($isLogged) {
        $canModify = true;
    } else {
        header('Location: accueil.html');
    }
}

// If the user is looking at is own profile
if ($canModify) {   //TODO ADD IMAGE TO FILE WITH FILE INPUT (check if png or jpg, resize, rename to (id).png ex: 1.png 2.png ect...)
    $userInstance->id = $sessionId;
} else { // If the user look another player profile
    $userInstance->id = $urlId;
}
$user = $userInstance->getUserByID();
if (is_object($user)) {
    $userInstance->username = $user->username;
    $userInstance->email = $user->email;
} else {
    http_response_code(404);
    include('error404.php');
    die();
}

$userImage = helpers::getUserImageName($userInstance->id);
if ($userImage != 'user-image.png') {
    $userImageExist = true;
}
session_write_close();
