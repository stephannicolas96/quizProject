<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';

session_start();

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
    foreach ($result['data'] as $user) {
        if (!file_exists(path::getUserImagesPath() . $user->image)) {
            $user->image = 'user-image.png';
        }
    }
    $result['success'] = true;
}

echo json_encode($result);

session_write_close();
