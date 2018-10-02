<?php

include_once path::getClassesPath() . 'database.php';

class langageType extends database {

    public $id;
    public $type;
    
    public function getAllLangages(){
        $query = 'SELECT `id`, `type` '
                . 'FROM `' . database::PREFIX . 'langageType`';

        if (database::getInstance()->query($query)) {
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }
    }

}
