<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'user.php';

session_start();

$userInstance = new user();

$result = array();

if (!empty($_POST['username'])) {
    $userInstance->username = htmlspecialchars($_POST['username']);
}

$result = $userInstance->getTenUsernameLike();
foreach ($result as $user) {
    if (!file_exists(path::getUserImagesPath() . $user->image)) {
        $user->image = 'user-image.png';
    }
}

echo json_encode($result);

session_write_close();
