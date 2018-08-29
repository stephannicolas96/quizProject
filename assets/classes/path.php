<?php

class path {

    private static $classes = 'assets/classes/';
    private static $controllers = 'assets/controllers/';
    private static $layout = 'assets/layout/';
    private static $images = 'assets/images/';
    private static $userImages = 'userImages/';
    private static $langage = 'assets/langage/';
    private static $regex = 'assets/classes/regex.php';
    private static $helpers = 'assets/classes/helpers.php';
    private static $database = 'assets/classes/database.php';

    public static function getClasses() {
        return self::$classes;
    }

    public static function getControllers() {
        return self::$controllers;
    }

    public static function getLayout() {
        return self::$layout;
    }

    public static function getImages() {
        return self::$images;
    }

    public static function getUserImages() {
        return self::$userImages;
    }
    
    public static function getLangage() {
        return self::$langage;
    }

    public static function getRegex() {
        return self::$regex;
    }

    public static function getHelpers() {
        return self::$helpers;
    }

    public static function getDatabase() {
        return self::$database;
    }

}
