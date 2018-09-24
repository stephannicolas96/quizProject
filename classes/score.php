<?php

include_once path::getClassesPath() . 'database.php';

class score extends database {

    public $id;
    public $points;
    public $userId;
    public $languageType;

    /**
     * Get user scores using ID
     * (null = no user found, obj = user data)
     * @return obj
     */
    public function getUserScoresById() {
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $query = 'SELECT `cppScore`, `phpScore`'
                    . 'FROM `' . $this->prefix . 'score` '
                    . 'WHERE `id` = :id';
            
            $getUserScores = database::getInstance()->prepare($query);
            $getUserScores->bindValue(':id', $this->id, PDO::PARAM_STR);

            if ($getUserScores->execute()) {
                return $getUserScores->fetch(PDO::FETCH_OBJ);
            }
        }
    }
    
    public function getTopThreePlayers(){
        
    }
}
