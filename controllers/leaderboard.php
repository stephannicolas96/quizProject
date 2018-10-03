<?php

session_start();

include_once path::getClassesPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();

$scoreInstance->langageType = 1;
$leaderboardTop = $scoreInstance->getTopThreeByLanguageTypeOrdered();
foreach ($leaderboardTop as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

$scoreInstance->userId = 14;
$leaderboardAroungPlayer = $scoreInstance->getScoresAroundUserByLanguageTypeOrdered();
foreach ($leaderboardAroungPlayer as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

session_write_close();
