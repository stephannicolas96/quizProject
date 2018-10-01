<?php

session_start();

include_once path::getClassesPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();

$scoreInstance->langageType = 1;
$leaderboardTop = $scoreInstance->getTopThreeByLanguageTypeOrdered();

$scoreInstance->userId = 14;
$leaderboardAroungPlayer = $scoreInstance->getScoresAroundUserByLanguageTypeOrdered();
session_write_close();