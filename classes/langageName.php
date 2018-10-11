<?php

include_once path::getClassesPath() . 'database.php';

class langageName extends database {

    public $id;
    public $name;

    /**
     * 
     * @return type
     */
    public function getAllLangages() {
        $returnValue = array();
        $query = 'SELECT `name` '
                . 'FROM `' . database::PREFIX . 'langageName` ';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

}
