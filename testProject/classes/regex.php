<?php

class regex {

    private static $prefix = '/^[A-z0-9]+[_]{1}$/';
    private static $id = '/^[0-9]+$/';
    //Minimum 8 characters
    private static $badPassword = '/(?=.{8,}).*/';
    //Alpha Numeric plus minimum 8
    private static $goodPassword = '/^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
    private static $betterPassword = '/^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
    private static $bestPassword = '/^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/';

    public static function getPrefixRegex() {
        return self::$prefix;
    }

    public static function getIdRegex() {
        return self::$id;
    }

    public static function getBadPasswordRegex() {
        return self::$badPassword;
    }

    public static function getGoodPasswordRegex() {
        return self::$goodPassword;
    }

    public static function getBetterPasswordRegex() {
        return self::$betterPassword;
    }

    public static function getBestPasswordRegex() {
        return self::$bestPassword;
    }

}
