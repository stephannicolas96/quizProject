<?php

class regex {

    private static $prefix = '/^[A-z0-9]+[_]{1}$/';
    private static $username = '/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]{3,30}$/';
    private static $mail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    private static $password = '/^(?=(\w|[!@#$%])*?[!@#$%\d]{2,})(\w|[!@#$%]){7,30}/';

    public function getPrefix() {
        return self::$prefix;
    }

    public function getUsername() {
        return self::$username;
    }

    public function getMail() {
        return self::$mail;
    }

    public function getPassword() {
        return self::$password;
    }

}
