<?php

class path {

    private static $absolutePath = null;
    private static $assets = 'assets/';
    private static $classes = 'classes/';
    private static $controllers = 'controllers/';
    private static $images = 'images/';
    private static $langage = 'langage/';
    private static $layout = 'layout/';
    private static $userImages = 'userImages/';

    public static function initAbsolutePath() {
        self::$absolutePath = substr(realPath(__FILE__), 0, -16);
    }

    public static function getClassesPath() {
        return self::$absolutePath . self::$classes;
    }

    public static function getControllersPath() {
        return self::$absolutePath . self::$controllers;
    }

    public static function getImagesPath() {
        return self::$absolutePath . self::$assets . self::$images;
    }

    public static function getLangagePath() {
        return self::$absolutePath . self::$langage;
    }

    public static function getLayoutPath() {
        return self::$absolutePath . self::$layout;
    }

    public static function getUserImagesPath() {
        return self::$absolutePath . self::$assets . self::$images . self::$userImages;
    }

}
path::initAbsolutePath();
