<?php
    include_once path::getClasses() .'leaderboard.php';
    
    $leaderboardInstance = new leaderboard();
    $leaderboardTop = $leaderboardInstance->getTopThreeLeaderboard();
    $leaderboardAroundUser = null;

