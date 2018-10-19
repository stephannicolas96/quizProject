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
                . 'FROM `' . config::PREFIX . 'langageName` ';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetchAll(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

    public function getRandomLangage() {
        $returnValue = -1;
        $query = 'SELECT `ln`.`id`' .
                'FROM `T7rDZC_langageName` AS `ln` ' .
                'JOIN (SELECT ' .
                'ROUND(RAND() * (SELECT ' .
                'MAX(`id`) ' .
                'FROM `T7rDZC_langageName` ' .
                ')) AS `id` ' .
                ') AS `x`' .
                'WHERE `ln`.`id` >= `x`.`id`' .
                'LIMIT 1';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetch(pdo::FETCH_COLUMN);
        }
        return $returnValue;
    }

}
