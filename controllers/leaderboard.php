<?php

session_start();

include_once path::getModelsPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();
$colors = array('gold','silver','bronze');

if (isset($_GET['langage'])) {
    $scoreInstance->id_langageName = htmlspecialchars($_GET['langage']);
} else {
    $scoreInstance->id_langageName = 1;
}

$leaderboardTop = $scoreInstance->getTopThree();

if (isset($_SESSION['id'])) {
    $scoreInstance->id_user = htmlspecialchars($_SESSION['id']);
    $leaderboardTwentyPlayers = $scoreInstance->getLeaderboardAroundPlayer();
} else {
    $leaderboardTwentyPlayers = $scoreInstance->getTopTwentyOffsetThree();
}

if (count($leaderboardTwentyPlayers) == 0 || count($leaderboardTop) == 0) {
    header('Location: home.html');
}

session_write_close();
