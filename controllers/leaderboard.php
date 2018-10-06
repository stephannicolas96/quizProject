<?php

session_start();

include_once path::getClassesPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();

if (isset($_GET['type'])) {
    $scoreInstance->langageType = htmlspecialchars($_GET['type']);
} else {
    $scoreInstance->langageType = 1;
}

$leaderboardTop = $scoreInstance->getTopThree();
foreach ($leaderboardTop as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

if (isset($_SESSION['id'])) {
    $scoreInstance->userId = $_SESSION['id'];
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
    header('Location: accueil.html');
}

session_write_close();
