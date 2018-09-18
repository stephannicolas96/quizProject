<?php

include_once path::getClassesPath() . 'database.php';

class duel extends database {

    public function deleteExpiredDuel() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $deleteExpiredDuel = $this->db->prepare('DELETE FROM `' . $this->prefix . 'duel` WHERE `startTime` < NOW() - INTERVAL 7 DAY');

            if ($deleteExpiredDuel->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

    public function createDuel() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $currentTime = new DateTime();

            $createDuel = $this->db->prepare('INSERT INTO `' . $this->prefix . 'duel` (`id_' . $this->prefix . 'question`, `id_' . $this->prefix . 'user`, `id_' . $this->prefix . 'user_playerOneId`, `startTime`) VALUES(:questionId, :playerTwoId, :playerOneId, FROM_UNIXTIME(:startTime))');
            $createDuel->bindValue(':questionId', $this->mail, PDO::PARAM_INT);
            $createDuel->bindValue(':playerOneId', $this->username, PDO::PARAM_INT);
            $createDuel->bindValue(':playerTwoId', $this->hashedPassword, PDO::PARAM_INT);
            $createDuel->bindValue(':startTime', $currentTime->getTimestamp(), PDO::PARAM_STR);


            if ($createDuel->execute()) {
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

}
