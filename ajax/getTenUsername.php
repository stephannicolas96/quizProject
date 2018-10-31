<?php

session_start();

include_once '../classes/path.php';
include_once path::getModelsPath() . 'user.php';


$userInstance = new user();

$result = array();
$result['success'] = false;

if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $userInstance->id = htmlspecialchars($_SESSION['id']);
}

if (!empty($_POST['username'])) {
    $userInstance->username = htmlspecialchars($_POST['username']);
}

$result['data'] = $userInstance->getTenUsernameLike();
if (count($result['data']) != 0) {
    $result['success'] = true;
}

echo json_encode($result);

session_write_close();
