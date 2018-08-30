<?php

class regex {

    private static $prefix = '/^[A-z0-9]+[_]{1}$/';
    private static $username = '/^[a-zA-Z0-9àáâãäåçèéêëìíîïðòóôõöùúûüýÿ-]{3,30}$/';
    private static $mail = '/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    private static $password = '/^(?=(\w|[!@#$%])*?[!@#$%\d]{2,})(\w|[!@#$%]){7,30}/';

    public static function getPrefixRegex() {
        return self::$prefix;
    }

    public static function getUsernameRegex() {
        return self::$username;
    }

    public static function getMailRegex() {
        return self::$mail;
    }

    public static function getPasswordRegex() {
        return self::$password;
    }

}
