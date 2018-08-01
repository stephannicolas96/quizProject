<?php
    include_once path::$classes .'leaderboard.php';
    
    $leaderboardInstance = new leaderboard();
    $leaderboardTop = $leaderboardInstance->getTopThreeLeaderboard();
    $leaderboardAroundUser = null;

