<?php

include_once path::getClassesPath() . 'user.php';

if(isset($_SESSION['logged'])){
    header('Location: index.php');
}

$registrationUserInstance = new user();
$registrationSuccess = false;
$registrationErrors = array();

$savedUsername = null;
$savedMail = null;

if (isset($_POST['register'])) {
    unset($_POST['register']);

    //USERNAME
    if (!empty($_POST['username'])) {
        if (preg_match(regex::getUsernameRegex(), $_POST['username'])) {
            $registrationUserInstance->username = $_POST['username'];
            $savedUsername =  htmlspecialchars($registrationUserInstance->username);
        } else {
            $registrationErrors['username'] = defined('usernameRegexFail') ? usernameRegexFail : 'Username incorrect';
        }
    } else {
        $registrationErrors['username'] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
    }
    unset($_POST['username']);

    //MAIL
    if (!empty($_POST['mail'])) {
        if (preg_match(regex::getMailRegex(), $_POST['mail'])) {
            $registrationUserInstance->mail = $_POST['mail'];
            $savedMail =  htmlspecialchars($registrationUserInstance->mail);
        } else {
            $registrationErrors['mail'] = defined('mailRegexFail') ? mailRegexFail : 'Mail incorrect';
        }
    } else {
        $registrationErrors['mail'] = defined('mailEmpty') ? mailEmpty : 'Mail can\'t be empty';
    }
    unset($_POST['mail']);

    //PASSWORD
    if (!empty($_POST['password'])) {
        if (preg_match(regex::getPasswordRegex(), $_POST['password'])) {
            $registrationUserInstance->password = $_POST['password'];
        } else {
            $registrationErrors['password'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
        }
    } else {
        $registrationErrors['password'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
    }
    unset($_POST['password']);


    //CONFIRM PASSWORD
    if (!empty($_POST['confirmPassword'])) {
        if (preg_match(regex::getUsernameRegex(), $_POST['confirmPassword'])) {
            $registrationUserInstance->confirmPassword = $_POST['confirmPassword'];
        } else {
            $registrationErrors['confirmPassword'] = defined('passwordRegexFail') ? passwordRegexFail : 'Password incorrect';
        }
    } else {
        $registrationErrors['confirmPassword'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
    }
    unset($_POST['confirmPassword']);


    //VERIFICATION DE LA CORRESPONDANCE DES MOT DE PASSES
    if (!empty($registrationUserInstance->password) && !empty($registrationUserInstance->confirmPassword)) {
        if ($registrationUserInstance->password === $registrationUserInstance->confirmPassword) {
            $registrationUserInstance->hashedPassword = password_hash($registrationUserInstance->password, PASSWORD_BCRYPT);
        } else {
            $registrationErrors['passwordDiff'] = passwordNotCorresponding;
        }
    }

    //VERIFICATION DE LA QUANTITE D'ERREUR ET AJOUT A LA BDD
    if (count($registrationErrors) == 0) {
        $mailAlreadyExist = $registrationUserInstance->checkIfMailAlreadyExist();
        $usernameAlreadyExist = $registrationUserInstance->checkIfUsernameAlreadyExist();
        if (!$mailAlreadyExist && !$usernameAlreadyExist) {
            if ($registrationUserInstance->addUser()) {
                $savedUsername = null;
                $savedMail = null;
                $registrationSuccess = true;
            } else {
                $registrationErrors['registration'] = registrationFailed;
            }
        }

        if ($mailAlreadyExist && !isset($registrationErrors['mail'])) {
            $registrationErrors['mail'] = mailAlreadyUsed;
        }

        if ($usernameAlreadyExist && !isset($registrationErrors['username'])) {
            $registrationErrors['username'] = usernameAlreadyUsed;
        }
    }
}