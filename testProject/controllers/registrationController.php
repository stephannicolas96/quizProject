<?php

include_once path::getClassesPath() . 'user.php';

$registrationUserInstance = new user();
$registrationSuccess = false;
$registrationErrors = array();

if (isset($_POST['register'])) {

    //USERNAME
    if (!empty($_POST['username'])) {
        $registrationUserInstance->username = htmlspecialchars($_POST['username']);
    } else {
        $registrationErrors['username'] = defined('usernameEmpty') ? usernameEmpty : 'Username can\'t be empty';
    }

    //EMAIL
    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $registrationUserInstance->email = htmlspecialchars($_POST['email']);
        } else {
            $registrationErrors['email'] = defined('emailIncorrect') ? emailIncorrect : 'Email incorrect';
        }
    } else {
        $registrationErrors['email'] = defined('emailEmpty') ? emailEmpty : 'Email can\'t be empty';
    }

    //PASSWORD
    if (!empty($_POST['password'])) {
        $registrationUserInstance->password = htmlspecialchars($_POST['password']);
        $registrationUserInstance->hashedPassword = password_hash($registrationUserInstance->password, PASSWORD_BCRYPT);
    } else {
        $registrationErrors['password'] = defined('passwordEmpty') ? passwordEmpty : 'Password can\'t be empty';
    }

    //VERIFICATION DE LA QUANTITE D'ERREUR ET AJOUT A LA BDD
    if (count($registrationErrors) == 0) {
        $mailAlreadyExist = $registrationUserInstance->checkIfEmailAlreadyExist();
        $usernameAlreadyExist = $registrationUserInstance->checkIfUsernameAlreadyExist();
        if (!$mailAlreadyExist && !$usernameAlreadyExist) {
            if ($registrationUserInstance->addUser()) {
                $registrationUserInstance->username = null;
                $registrationUserInstance->email = null;
                $registrationSuccess = true;
            } else {
                $registrationErrors['registration'] = defined('registrationFailed') ? registrationFailed : 'Registration failed! Please try again later.';
            }
        }

        if ($mailAlreadyExist && !isset($registrationErrors['email'])) {
            $registrationErrors['email'] = defined('emailAlreadyUsed') ? emailAlreadyUsed : 'Email already used';
        }

        if ($usernameAlreadyExist && !isset($registrationErrors['username'])) {
            $registrationErrors['username'] = usernameAlreadyUsed;
        }
    }
}