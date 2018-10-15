<?php

include_once path::getClassesPath() . 'database.php';

class duelState extends database {

    public $id;
    public $name;

    public function getAllStates() {
        $returnValue = array();
        $query = 'SELECT `name` '
                . 'FROM `' . database::PREFIX . 'duelState`';
        
        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

}
