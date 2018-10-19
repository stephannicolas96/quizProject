<?php

include_once path::getRootPath() . 'config.php';
include_once path::getClassesPath() . 'regex.php';
include_once path::getHelpersPath() . 'inputChecker.php';

class database {

    private static $_db;

    public static function getInstance() {
        if (is_null(self::$_db)) {
            try {
                self::$_db = new PDO('mysql:host=' . config::SERVER_NAME . ';dbname=' . config::DATABASE_NAME . ';charset=utf8', config::USER_NAME, config::PASSWORD);
                self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //TODO REMOVE TO AVOID DISPLAYING SQL ERROR
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$_db;
    }

    public function getLastInsertedId() {
        $returnValue = -1;
        $query = 'SELECT LAST_INSERT_ID() AS `id`';

        if ($result = self::getInstance()->query($query)) {
            $returnValue = $result->fetch(pdo::FETCH_COLUMN);
        }

        return $returnValue;
    }

}
