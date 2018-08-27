<?php

if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
    $_GET['lang'] = $lang;
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $_GET['lang'] = $lang;
}

setcookie("lang", $lang, time() + 365 * 24 * 3600);

switch ($lang) {
    case 'fr':
        include path::getLangage() . 'fr_FR.php';
        break;
    case 'en':
        include path::getLangage() . 'en_EN.php';
        break;
}