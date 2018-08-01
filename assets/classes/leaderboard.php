<?php

include_once path::$database;

class leaderboard extends database {

    public function __construct() {
        parent::__construct();
    }

    /*
     * 
     */

    public function getTopThreeLeaderboard() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $scoreTable = $this->prefix . 'score';
            $userTable = $this->prefix . 'user';
            $topThreePlayers = $this->db->prepare('SELECT * FROM `' . $scoreTable . '` AS `scoreT` LEFT JOIN `' . $userTable . '` AS `userT` ON `scoreT`.`id` = `userT`.`id` ORDER BY `score` DESC LIMIT 3');

            if ($topThreePlayers->execute()) {
                return $topThreePlayers->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return -1;
            }
        }

        return -2;
    }

    /*
     * 
     */

    public function getLeaderboardAroundPlayer() {
        if (preg_match(regex::$prefix, $this->prefix)) {
            $scoreTable = $this->prefix . 'score';
            $userTable = $this->prefix . 'user';
            $aroundPlayer = $this->db->prepare('');
        }

        return -2;
    }

}
