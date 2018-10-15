<?php

session_start();

include_once path::getClassesPath() . 'user.php';
include_once path::getClassesPath() . 'userDuel.php';

$userInstance = new user();
$userDuelInstance = new userDuel();

$modifying = false;
$canModify = false;
$isLogged = (isset($_SESSION['logged'])) ? $_SESSION['logged'] : false;
$sessionId = (isset($_SESSION['id'])) ? $_SESSION['id'] : -1;
$userImageExist = false;

if (isset($_GET['id']) && preg_match(regex::getIdRegex(), $_GET['id'])) {
    $urlId = htmlspecialchars($_GET['id']);
    if ($urlId == $sessionId) {
        $canModify = true;
    }
} else {
    if ($isLogged) {
        $canModify = true;
    } else {
        header('Location: home.html');
    }
}

// If the user is looking at is own profile
if ($canModify) {   //TODO ADD IMAGE TO FILE WITH FILE INPUT (check if png or jpg, resize, rename to (id).png ex: 1.png 2.png ect...)
    $userInstance->id = $userDuelInstance->id_user = $sessionId;
} else if (isset($urlId)) { // If the user look another player profile
    $userInstance->id = $userDuelInstance->id_user = $urlId;
}
$user = $userInstance->getUserByID();
if (is_object($user)) {
    $userInstance->username = $pageTitle = $user->username;
    $userInstance->email = $user->email;
    $userInstance->color = $user->color;
} else {
    header('Location: home.html');
}
$userDuelData = $userDuelInstance->getPlayerData();
$userDuelDataTransformed = array();
if (!is_array($userDuelData)) {
    header('Location: home.html');
} else {
    $langage = null;
    foreach ($userDuelData as $data) {
        if ($langage != $data->langage) {
            $langage = $data->langage;
            $userDuelDataTransformed[$data->langage] = array();
        }
        if ($data->state != 'inProgress') {
            $userDuelDataTransformed[$data->langage][$data->state] = $data->amount;
        }
    }
}

$profileInputs = [
    (object) [
        'wrappingDivClasses' => 'input-field',
        'inputAttr' => 'id="username" type="text" name="username"  value="' . $userInstance->username . '" maxlength="60" required',
        'labelContent' => USERNAME,
        'labelAttr' => 'username'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field',
        'inputAttr' => 'id="email" type="text" name="email" value="' . $userInstance->email . '" maxlength="255" required',
        'labelContent' => EMAIL,
        'labelAttr' => 'email'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field password',
        'inputAttr' => 'id="actualPassword" type="password" name="actualPassword" maxlength="60" required',
        'labelContent' => PASSWORD,
        'labelAttr' => 'actualPassword'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field password',
        'inputAttr' => 'id="newPassword" type="password" name="newPassword" maxlength="60" strength="0"',
        'labelContent' => NEW_PASSWORD,
        'labelAttr' => 'newPassword'
    ]
];

if (file_exists(path::getUserImagesPath() . $user->image)) {
    $userImage = $user->image;
    $userImageExist = true;
} else {
    $userImage = 'user-image.png';
}
session_write_close();
