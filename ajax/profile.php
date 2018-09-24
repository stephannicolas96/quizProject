<?php
//TODO : JUST DO IT !!!!!!!!!!
session_start();
$errors = array();

if (isset($_POST['stopUpdate'])) { //STOP UPDATE
} else if (isset($_POST['update'])) { //UPDATE USER DATA
    if (!empty($_POST['username'])) {
        if (preg_match(regex::getUsernameRegex(), $_POST['username'])) {
            $profileUserInstance->username = $_POST['username'];
            $savedUsername = htmlspecialchars($profileUserInstance->username);
        } else {
            $errors['username'] = defined('usernameRegexFail') ? usernameRegexFail : 'Username incorrect';
        }
    } else {
        $errors['username'] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
    }

    if (!empty($_POST['mail'])) {
        if (preg_match(regex::getMailRegex(), $_POST['mail'])) {
            $profileUserInstance->mail = $_POST['mail'];
            $savedMail = htmlspecialchars($profileUserInstance->mail);
        } else {
            $errors['mail'] = defined('mailRegexFail') ? mailRegexFail : 'Mail incorrect';
        }
    } else {
        $errors['mail'] = defined('mailEmpty') ? mailEmpty : 'Mail can\'t be empty';
    }

    if (!empty($_POST['actualPassword'])) {
        if (preg_match(regex::getPasswordRegex(), $_POST['actualPassword'])) {
            $profileUserInstance->password = $_POST['actualPassword'];
        } else {
            $errors['actualPassword'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
        }
    } else {
        $errors['actualPassword'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
    }

    if (!empty($_POST['newPassword'])) {
        if (preg_match(regex::getPasswordRegex(), $_POST['newPassword'])) {
            $profileUserInstance->newPassword = $_POST['newPassword'];
            $profileUserInstance->hashedPassword = password_hash($profileUserInstance->newPassword, PASSWORD_BCRYPT);
            $passwordChanged = true;
        } else {
            $errors['newPassword'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
        }
    }

    if (count($errors) == 0 && password_verify($profileUserInstance->password, $profileUserInstance->databaseHashedPassword)) {
        if ($passwordChanged) {
            $profileUserInstance->updateUserWithPasswordById();
        } else {
            $profileUserInstance->updateUserWithoutPasswordById();
        }
    } else {
        $errors['password'] = 'wrongPassword';
        $modifying = true;
    }
} else if (isset($_POST['deleteUserImage'])) { //DELETE USER IMAGE
    $modifying = true;
    if ($userImageExist) {
        unlink($savedUserImagePath);
    }
} else if (isset($_POST['deleteUser'])) { // DELETE USER
    $profileUserInstance->deleteUserById();
    session_unset();
    header('Location: accueil.html');
}