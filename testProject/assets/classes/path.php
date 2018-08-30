<?php

class path {

    private static $assets = 'assets/';
    private static $classes = 'classes/';
    private static $controllers = 'controllers/';
    private static $css = 'css/';
    private static $fonts = 'fonts/';
    private static $images = 'images/';
    private static $js = 'js/';
    private static $langage = 'langage/';
    private static $layout = 'layout/';
    private static $userImages = 'userImages/';
    private static $import = 'import/';

    public static function getClassesPath() {
        return self::$assets . self::$classes;
    }
    public static function getControllersPath() {
        return self::$assets . self::$controllers;
    }
    public static function getCssPath() {
        return self::$assets . self::$css;
    }
    public static function getCssImportPath() {
        return self::$assets . self::$css . self::$import;
    }
    public static function getFontsPath() {
        return self::$assets . self::$fonts;
    }
    public static function getImagesPath() {
        return self::$assets . self::$images;
    }
    public static function getJsPath() {
        return self::$assets . self::$js;
    }
    public static function getJsImportPath() {
        return self::$assets . self::$js . self::$import;
    }
    public static function getLangagePath() {
        return self::$assets . self::$langage;
    }
    public static function getLayoutPath() {
        return self::$assets . self::$layout;
    }
    public static function getUserImagesPath() {
        return self::$assets . self::$images . self::$userImages;
    }

}
