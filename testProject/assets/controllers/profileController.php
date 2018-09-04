<?php

/*
 * $_POST VALUE
 * 
 * deleteUser: submit / de suppression d'utilisateur
 * stopUpdate: submit / annulation de la modification
 * update: submit / sauvegarde des données
 * deleteUserImage: submit / efface l'image de l'utilisateur
 * 
 * username: nom d'utilisateur a enregistrer
 * mail: mail de l'utilisateur a enregistrer
 * actualPassword: ancien password (necessaire pour s'assurer que l'utilisateur est bien le propriétaire du compte)
 * newPassword: nouveau password a enregistrer
 */

include_once path::getClassesPath() . 'user.php';

$profileUserInstance = new user();
$userImageExist = null;
$savedUserImagePath = null;
$savedUsername = null;
$savedMail = null;
$passwordChanged = false;
$profileErrors = array();

$isLogged = isset($_SESSION['logged']);
$currentUserTarget = true;
$id = (isset($_GET['id']) && preg_match(regex::getIdRegex(), $_GET['id'])) ? $_GET['id'] : 0;
$userId = (isset($_SESSION['id'])) ? $_SESSION['id'] : -1;
$canModify = false; 
$modifying = false;

// Check if the user is looking for is own profile to allow modification 
if ($isLogged && $id != 0 && $userId != -1) {
    $currentUserTarget = ($id == $userId);
} else if ($id == 0) {
    $currentUserTarget = true;
} else {
    $currentUserTarget = false;
}

// If the user is looking at is own profile
if ($currentUserTarget) {   //TODO ADD IMAGE TO FILE WITH FILE INPUT (check if png or jpg, resize, rename to (id).png ex: 1.png 2.png ect...)
    $canModify = true;
    if ($isLogged) {
        $profileUserInstance->id = ($_SESSION['id']) ? $_SESSION['id'] : -1;
        if ($profileUserInstance->getUserByID()) {
            $userImageExist = file_exists(path::getUserImagesPath() . $profileUserInstance->id . '.png');
            if ($userImageExist) {
                $savedUserImagePath = path::getUserImagesPath() . $profileUserInstance->id . '.png';
            }
            $savedUsername = htmlspecialchars($profileUserInstance->username);
            $savedMail = htmlspecialchars($profileUserInstance->mail);
        }
    } else { //User Disconnected
        header('Location: index.php');
    }
    if(isset($_POST['modify'])){
        unset($_POST['modify']);
        $modifying = true;
    }
    if (isset($_POST['stopUpdate'])) { //STOP UPDATE
        unset($_POST['stopUpdate']);
        unset($_POST['update']);
    } else if (isset($_POST['update'])) { //UPDATE USER DATA
        unset($_POST['update']);
        if (!empty($_POST['username'])) {
            if (preg_match(regex::getUsernameRegex(), $_POST['username'])) {
                $profileUserInstance->username = $_POST['username'];
                $savedUsername = htmlspecialchars($profileUserInstance->username);
            } else {
                $profileErrors['username'] = defined('usernameRegexFail') ? usernameRegexFail : 'Username incorrect';
            }
        } else {
            $profileErrors['username'] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
        }

        if (!empty($_POST['mail'])) {
            if (preg_match(regex::getMailRegex(), $_POST['mail'])) {
                $profileUserInstance->mail = $_POST['mail'];
                $savedMail = htmlspecialchars($profileUserInstance->mail);
            } else {
                $profileErrors['mail'] = defined('mailRegexFail') ? mailRegexFail : 'Mail incorrect';
            }
        } else {
            $profileErrors['mail'] = defined('mailEmpty') ? mailEmpty : 'Mail can\'t be empty';
        }

        if (!empty($_POST['actualPassword'])) {
            if (preg_match(regex::getPasswordRegex(), $_POST['actualPassword'])) {
                $profileUserInstance->password = $_POST['actualPassword'];
            } else {
                $profileErrors['actualPassword'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
            }
        } else {
            $profileErrors['actualPassword'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
        }

        if (!empty($_POST['newPassword'])) {
            if (preg_match(regex::getPasswordRegex(), $_POST['newPassword'])) {
                $profileUserInstance->newPassword = $_POST['newPassword'];
                $profileUserInstance->hashedPassword = password_hash($profileUserInstance->newPassword, PASSWORD_BCRYPT);
                $passwordChanged = true;
            } else {
                $profileErrors['newPassword'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
            }
        }

        if (count($profileErrors) == 0 && password_verify($profileUserInstance->password, $profileUserInstance->databaseHashedPassword)) {
            if ($passwordChanged) {
                $profileUserInstance->updateUserWithPasswordById();
            } else {
                $profileUserInstance->updateUserWithoutPasswordById();
            }
        } else {
            $profileErrors['password'] = 'wrongPassword';
            $modifying = true;
        }
    } else if (isset($_POST['deleteUserImage'])) { //DELETE USER IMAGE
        unset($_POST['deleteUserImage']);
        $modifying = true;
        if ($userImageExist) {
            unlink($savedUserImagePath);
        }
    } else if (isset($_POST['deleteUser'])) { // DELETE USER
        unset($_POST['deleteUser']);
        $profileUserInstance->deleteUserById();
        session_unset();
        header('Location: index.php');
    }
} else { // If the user look another player profile
    $canModify = false;
    $profileUserInstance->id = $id;
    if ($profileUserInstance->getUserByID()) {
        $userImageExist = file_exists(path::getUserImagesPath() . $profileUserInstance->id . '.png');
        if ($userImageExist) {
            $savedUserImagePath = path::getUserImagesPath() . $profileUserInstance->id . '.png';
        }
        $savedUsername = htmlspecialchars($profileUserInstance->username);
        $savedMail = htmlspecialchars($profileUserInstance->mail);
    }
}

