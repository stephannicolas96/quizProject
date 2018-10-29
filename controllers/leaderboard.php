<?php
session_start();

include_once path::getModelsPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();
$colors = array('gold','silver','bronze');

//get the leaderboard langage id to display
if (isset($_GET['langage'])) { 
    $scoreInstance->id_langageName = htmlspecialchars($_GET['langage']);
} else {
    $scoreInstance->id_langageName = 1;
}

//get the leaderboard top
$leaderboardTop = $scoreInstance->getTopThree();


//if the user id is set get the leaderboard around the player and if it isn't set get the top 3 to 23 leaderboard
if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $scoreInstance->id_user = htmlspecialchars($_SESSION['id']);
    $leaderboardTwentyPlayers = $scoreInstance->getLeaderboardAroundPlayer();
} else {
    $leaderboardTwentyPlayers = $scoreInstance->getTopTwentyOffsetThree();
}

//if both leaderboard are empty we set leaderboardEmpty to true to display a correspondin message
if (count($leaderboardTwentyPlayers) == 0 && count($leaderboardTop) == 0) {
    $leaderboardEmpty = true;
}

session_write_close();
