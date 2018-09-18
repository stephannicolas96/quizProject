<?php
$langages = ['fr', 'en'];

if(isset($_GET['lang']) && in_array($_GET['lang'], $langages)){
   $lang = $_GET['lang'];
} else if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $langages)) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

setcookie("lang", $lang, time() + 365 * 24 * 3600);

switch ($lang) {
    case 'fr':
        include path::getLangagePath() . 'fr_FR.php';
        break;
    case 'en':
    default:
        include path::getLangagePath() . 'en_EN.php';
        break;
}