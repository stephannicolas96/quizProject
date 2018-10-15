<?php
session_start();

include_once path::getClassesPath() . 'duel.php';
include_once path::getClassesPath() . 'userDuel.php';
include_once path::getClassesPath() . 'langageName.php';

$duelInstance = new duel();
$userDuelInstance = new userDuel();
$langageNameInstance = new langageName();

$allLangages = $langageNameInstance->getAllLangages();

if (isset($_SESSION['id'])) {
    $userDuelInstance->id_user = $_SESSION['id'];
    $duels = array();
    $duelsTemp = $userDuelInstance->getTwentyDuelByUserId();
    foreach ($duelsTemp as $id => $duel) {
        $user = $duel->currentUser ? 'currentUser' : 'opponent';
        $userState = $duel->currentUser ? 'currentUserState' : 'opponentState';
        $userDuelImage = $duel->currentUser ? 'currentUserImage' : 'opponentImage';
        $image = ($user == 'currentUser') ? 'you.png' : ((file_exists(path::getUserImagesPath() . $duel->image)) ? $duel->image : 'user-image.png');
        if ($id % 2 == 0) {
            $duels[$id] = (object) [];
            $duels[$id]->duelId = $duel->id;
            $i = $id;
        } else {
            $i = $id - 1;
        }
        $duels[$i]->$user = $duel->username;
        $duels[$i]->$userState = $duel->state;
        $duels[$i]->$userDuelImage = $image;
    }
    $duels = (object) $duels;
}

session_write_close();
