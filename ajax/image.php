<?php

session_start();

include_once '../classes/path.php';

$result = array();
$result['success'] = false;
$result['errors'] = array();

if (isset($_POST['submitType'])) {
    $submit = htmlspecialchars($_POST['submitType']);
    if ($submit == 0) {
        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : -1;
        $validextensions = array('png', 'jpg', 'jpeg');
        $validfiles = array('image/png', 'image/jpeg');
        $temporary = explode('.', $_FILES['userImage']['name']);
        $file_extension = end($temporary);
        $filename = $id;
        $targetPath = path::getUserImagesPath() . $filename;
        $sourcePath = $_FILES['userImage']['tmp_name'];

        if (in_array($_FILES['userImage']['type'], $validfiles) && $_FILES['userImage']['size'] < 500000 && in_array($file_extension, $validextensions) && getimagesize($_FILES['userImage']['tmp_name']) != false) { //500ko max image size
            if ($_FILES['userImage']['error'] > 0) {
                $result['errors'][] = 'An error occured'; //TODO TRADUCTION
            } else {
                if (file_exists($targetPath)) {
                    unlink($targetPath);
                }
                move_uploaded_file($sourcePath, $targetPath);
                $result['success'] = true;
            }
        } else {
            $result['errors'][] = 'Invalid file Size or Type'; //TODO TRADUCTION
        }
    } else if ($submit == 1) { //DELETE USER IMAGE
        $image = path::getUserImagesPath() . htmlspecialchars($_SESSION['id']);
        if (file_exists($image)) {
            unlink($image);
            $result['success'] = true;
        }
    }
}

echo json_encode($result);

session_write_close();
