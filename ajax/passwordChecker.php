<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';

$worst = 7;

$password = isset($_POST['inputValue']) ? $_POST['inputValue'] : '';

if (preg_match(regex::BEST_PASSWORD, $password)) {
    echo '5';
} else if (preg_match(regex::BETTER_PASSWORD, $password)) {
    echo '4';
} else if (preg_match(regex::GOOD_PASSWORD, $password)) {
    echo '3';
} else if (preg_match(regex::BAD_PASSWORD, $password)) {
    echo '2';
} else if (strlen($password) >= 1 && strlen($password) <= $worst) {
    echo '1';
} else if (strlen($password) < 1) {
    echo '0';
}
