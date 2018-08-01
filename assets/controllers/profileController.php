<?php

include_once path::$classes . 'user.php';

$profileUserInstance = new user();

if (!empty($_SESSION)) {
    $profileUserInstance->id = $_SESSION['id'];
    $profileUserInstance->getUserByID();
}