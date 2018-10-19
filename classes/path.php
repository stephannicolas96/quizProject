<?php

class path {

    private static $absolutePath = null;
    const ASSETS = 'assets/';
    const CLASSES = 'classes/';
    const CONTROLLERS = 'controllers/';
    const IMAGES = 'images/';
    const LANGAGE = 'lang/';
    const LAYOUT = 'layout/';
    const USERIMAGES = 'userImages/';
    const VIEWS = 'views/';
    const MODELS = 'models/';
    const HELPERS = 'helpers/';

    public static function getAbsolutePath() {
        if (is_null(self::$absolutePath)) {
            self::$absolutePath = explode('classes', __FILE__)[0];
        }
        return self::$absolutePath;
    }

    public static function getClassesPath() {
        return self::getAbsolutePath() . self::CLASSES;
    }

    public static function getControllersPath() {
        return self::getAbsolutePath() . self::CONTROLLERS;
    }

    public static function getImagesPath() {
        return self::getAbsolutePath() . self::ASSETS . self::IMAGES;
    }

    public static function getLangagePath() {
        return self::getAbsolutePath() . self::LANGAGE;
    }

    public static function getLayoutPath() {
        return self::getAbsolutePath() . self::LAYOUT;
    }

    public static function getUserImagesPath() {
        return self::getAbsolutePath() . self::ASSETS . self::IMAGES . self::USERIMAGES;
    }
    
     public static function getViewsPath() {
        return self::getAbsolutePath() . self::VIEWS;
    }
    
    public static function getModelsPath() {
        return self::getAbsolutePath() . self::MODELS;
    }
    
    public static function getHelpersPath() {
        return self::getAbsolutePath() . self::HELPERS;
    }
    
    public static function getRootPath(){
        return self::getAbsolutePath();
    }
}