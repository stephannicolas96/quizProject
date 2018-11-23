<?php
session_start();

include_once path::getModelsPath() . 'userDuel.php';
include_once path::getModelsPath() . 'langageName.php';

$userDuelInstance = new userDuel();
$langageNameInstance = new langageName();

$allLangages = $langageNameInstance->getAllLangages();

$duels = array();
if (isset($_SESSION['id'])) {
    $userDuelInstance->id_user = htmlspecialchars($_SESSION['id']);
    $duels = $userDuelInstance->getTwentyDuelByUserId();
}

session_write_close();
