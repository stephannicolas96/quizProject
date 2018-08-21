<?php

class path {

    private static $classes = 'assets/classes/';
    private static $controllers = 'assets/controllers/';
    private static $layout = 'assets/layout/';
    private static $images = 'assets/images/';
    private static $userImages = 'userImages/';
    private static $regex = 'assets/classes/regex.php';
    private static $helpers = 'assets/classes/helpers.php';
    private static $database = 'assets/classes/database.php';

    public function getClasses() {
        return self::$classes;
    }

    public function getControllers() {
        return self::$controllers;
    }

    public function getLayout() {
        return self::$layout;
    }

    public function getImages() {
        return self::$images;
    }

    public function getUserImages() {
        return self::$userImages;
    }

    public function getRegex() {
        return self::$regex;
    }

    public function getHelpers() {
        return self::$helpers;
    }

    public function getDatabase() {
        return self::$database;
    }

}
