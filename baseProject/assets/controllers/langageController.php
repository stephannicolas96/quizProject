<?php

//TODO : REGEX GET COOKIE

if(isset($_GET['lang'])){
   $lang = $_GET['lang'];
} else if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} else {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
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