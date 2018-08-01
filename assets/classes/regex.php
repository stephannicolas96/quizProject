<?php

class regex {

    public static $prefix = '/^[A-z0-9]+[_]{1}$/';
    public static $username = '/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]{3,30}$/';
    public static $mail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    public static $password = '/^(?=(\w|[!@#$%])*?[!@#$%\d]{2,})(\w|[!@#$%]){7,30}/';
    
}

