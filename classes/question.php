<?php

include_once path::getClassesPath() . 'database.php';

class question extends database {
    
    public $id;
    public $content;
    public $difficulty;
}