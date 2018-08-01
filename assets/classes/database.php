<?php
include_once path::$regex;
/*
 * Error Code : 
 * -2 echec de la regex
 * -1 echec d'execution de la requête
 * 0 requête vide
 * 1 requête avec contenu
 */
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