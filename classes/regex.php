<?php

class regex {

    const ID = '/^[0-9]+$/';
    //Minimum 8 characters
    const BAD_PASSWORD = '/(?=.{8,}).*/';
    //Alpha Numeric plus minimum 8
    const GOOD_PASSWORD = '/^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
    const BETTER_PASSWORD = '/^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
    const BEST_PASSWORD = '/^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/';

    public static function getIdRegex() {
        return self::ID;
    }

    public static function getBadPasswordRegex() {
        return self::BAD_PASSWORD;
    }

    public static function getGoodPasswordRegex() {
        return self::GOOD_PASSWORD;
    }

    public static function getBetterPasswordRegex() {
        return self::BETTER_PASSWORD;
    }

    public static function getBestPasswordRegex() {
        return self::BEST_PASSWORD;
    }

}
