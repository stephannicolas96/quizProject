<?php

session_start();

include_once path::getClassesPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();
$colors = array('gold','silver','bronze');

if (isset($_GET['type'])) {
    $scoreInstance->id_langageName = htmlspecialchars($_GET['type']);
} else {
    $scoreInstance->id_langageName = 1;
}

$leaderboardTop = $scoreInstance->getTopThree();
foreach ($leaderboardTop as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

if (isset($_SESSION['id'])) {
    $scoreInstance->id_user = htmlspecialchars($_SESSION['id']);
    $leaderboardTwentyPlayers = $scoreInstance->getLeaderboardAroundPlayer();
} else {
    $leaderboardTwentyPlayers = $scoreInstance->getTopTwentyOffsetThree();
}
foreach ($leaderboardTwentyPlayers as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

if (count($leaderboardTwentyPlayers) == 0 || count($leaderboardTop) == 0) {
    header('Location: home.html');
}

session_write_close();
