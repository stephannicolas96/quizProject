<?php

include_once path::getClassesPath() . 'database.php';

class langageType extends database {

    public $id;
    public $type;

    /**
     * 
     * @return type
     */
    public function getAllTypes() {
        $returnValue = array();
        $query = 'SELECT `type` '
                . 'FROM `' . database::PREFIX . 'langageType` ';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

}
