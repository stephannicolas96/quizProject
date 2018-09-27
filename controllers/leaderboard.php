<?php

session_start();

include_once path::getClassesPath() . 'score.php';

$scoreInstance = new score();
$leaderboardTop = array();

$scoreInstance->languageType = 1;
$leaderboardTop = $scoreInstance->getTopThreeByLanguageTypeOrdered();
$leaderboardAroungPlayer = $scoreInstance->getUserScoresByLanguageTypeOrdered();
session_write_close();