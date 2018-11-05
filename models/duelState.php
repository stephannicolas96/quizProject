<?php

include_once path::getClassesPath() . 'database.php';

class duelState extends database {

    public $id = 0;
    public $name = '';
    
    /**
     * get all duel states
     * @return array()
     */
    public function getAllStates() {
        $returnValue = array();
        $query = 'SELECT `name` '
                . 'FROM `' . config::PREFIX . 'duelState`';
        
        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

}
