<?php

session_start();

include_once path::getModelsPath() . 'user.php';
include_once path::getModelsPath() . 'userDuel.php';

$userInstance = new user();
$userDuelInstance = new userDuel();

$modifying = false;
$canModify = false;
$isLogged = (isset($_SESSION['logged']) && is_bool($_SESSION['logged'])) ? $_SESSION['logged'] : false;
$sessionId = (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) ? $_SESSION['id'] : -1;
$userImageExist = false;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $urlId = htmlspecialchars($_GET['id']);
    if ($urlId == $sessionId) {
        $canModify = true;
    }
} else {
    if ($isLogged) {
        $canModify = true;
    } else {
        header('Location: home');
    }
}

// If the user is looking at is own profile
if ($canModify) {
    $userInstance->id = $userDuelInstance->id_user = $sessionId;
} else if (isset($urlId)) { // If the user look another player profile
    $userInstance->id = $userDuelInstance->id_user = $urlId;
}
if (!$userInstance->getUserByID()) {
    header('Location: home');
}
$userDuelData = $userDuelInstance->getPlayerData();
$userDuelDataTransformed = array();
if (!is_array($userDuelData)) {
    header('Location: home');
} else {
    $langage = null;
    foreach ($userDuelData as $data) {
        if ($langage != $data->langage) {
            $langage = $data->langage;
            $userDuelDataTransformed[$data->langage] = array();
        }
        if ($data->state != 'inProgress' && $data->state != 'expiredButPlayed' && $data->state != 'waiting') {
            $userDuelDataTransformed[$data->langage][$data->state] = $data->amount;
        }
    }
}

$profileInputs = [
    (object) [
        'wrappingDivClasses' => 'input-field',
        'inputAttr' => 'id="username" type="text" name="username"  value="' . $userInstance->username . '" maxlength="255" required',
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
        'inputAttr' => 'id="actualPassword" type="password" name="actualPassword" maxlength="255" required',
        'labelContent' => PASSWORD,
        'labelAttr' => 'actualPassword'
    ],
    (object) [
        'wrappingDivClasses' => 'input-field password',
        'inputAttr' => 'id="newPassword" type="password" name="newPassword" maxlength="255" strength="0"',
        'labelContent' => NEW_PASSWORD,
        'labelAttr' => 'newPassword'
    ]
];

session_write_close();
