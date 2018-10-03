<?php

include_once path::getClassesPath() . 'regex.php';

class database {

    private static $_db;

    const PREFIX = 'T7rDZC_';
    const SERVER_NAME = 'localhost';
    const DATABASE_NAME = 'battlely';
    const USER_NAME = 'test';
    const PASSWORD = 'test';
    const CHARSET = 'utf8';

    public static function getInstance() {
        if (is_null(self::$_db)) {
            try {
                self::$_db = new PDO('mysql:host=' . self::SERVER_NAME . ';dbname=' . self::DATABASE_NAME . ';charset=' . self::CHARSET, self::USER_NAME, self::PASSWORD);
                self::$_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //TODO REMOVE TO AVOID DISPLAYING SQL ERROR
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$_db;
    }

}
