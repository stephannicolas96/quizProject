<?php
session_start();

include_once path::getModelsPath() . 'userDuel.php';
include_once path::getModelsPath() . 'langageName.php';

$userDuelInstance = new userDuel();
$langageNameInstance = new langageName();

$allLangages = $langageNameInstance->getAllLangages();

if (isset($_SESSION['id'])) {
    $userDuelInstance->id_user = htmlspecialchars($_SESSION['id']);
    $duels = array();
    $duels = $userDuelInstance->getTwentyDuelByUserId();
}

session_write_close();
