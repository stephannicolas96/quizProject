<?php
include_once path::getClassesPath() . 'regex.php';

class database {

    protected $db;
    protected $prefix = 'T7rDZC_';
    private $serverName = 'localhost';
    private $databaseName = 'quizProject';
    private $username = 'test';
    private $password = 'test';
    
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . $this->serverName . ';dbname=' . $this->databaseName, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

}