<?php

session_start();
$langages = ['fr', 'en'];

if (isset($_GET['lang']) && in_array($_GET['lang'], $langages)) {
    $lang = htmlspecialchars($_GET['lang']);
} else if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $langages)) {
    $lang = htmlspecialchars($_COOKIE['lang']);
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}

setcookie('lang', $lang, time() + 365 * 24 * 3600, '/');

switch ($lang) {
    case 'fr':
        include path::getLangagePath() . 'fr_FR.php';
        $_SESSION['lang'] = 'fr_FR.php';
        break;
    case 'en':
    default:
        include path::getLangagePath() . 'en_EN.php';
        $_SESSION['lang'] = 'en_EN.php';
        break;
}

switch ($pageTitle) {
    case 'HOME':
        $pageTitle = HOME;
        break;
    case 'BATTLE':
        $pageTitle = BATTLE;
        break;
    case 'CREATE':
        $pageTitle = CREATE;
        break;
    case 'LEADERBOARD':
        $pageTitle = LEADERBOARD;
        break;
    default:
        break;
}

$isLogged = (isset($_SESSION['logged'])) ? htmlspecialchars($_SESSION['logged']) : false;
$url = explode('/', $_SERVER['REQUEST_URI']);
$urlEnd = end($url);

session_write_close();
