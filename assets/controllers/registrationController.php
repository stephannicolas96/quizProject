<?php

include_once path::$classes . 'user.php';

$registrationUserInstance = new user();

$registrationSuccess = false;
$formError = array();

if (!empty($_POST) && isset($_POST['register'])) {

    //USERNAME
    if (isset($_POST['username'])) {

        $registrationUserInstance->username = htmlspecialchars($_POST['username']);

        if (!preg_match(regex::$username, $registrationUserInstance->username)) {
            $formError['username'] = 'Nom d\'utilisateur incorrecte';
        }

        if (empty($registrationUserInstance->username)) {
            $formError['username'] = 'Champs obligatoire';
        }
    }

    //MAIL
    if (isset($_POST['mail'])) {

        $registrationUserInstance->mail = htmlspecialchars($_POST['mail']);

        if (!preg_match(regex::$mail, $registrationUserInstance->mail)) {
            $formError['mail'] = 'Mail incorrecte';
        }

        if (empty($registrationUserInstance->mail)) {
            $formError['mail'] = 'Champs obligatoire';
        }
    }

    //PASSWORD
    if (isset($_POST['password'])) {

        $registrationUserInstance->password = htmlspecialchars($_POST['password']);

        if (!preg_match(regex::$password, $registrationUserInstance->password)) {
            $formError['password'] = 'Mot de passe incorrecte';
        }

        if (empty($registrationUserInstance->password)) {
            $formError['password'] = 'Champs obligatoire';
        }
    }


    //CONFIRM PASSWORD
    if (isset($_POST['confirmPassword'])) {

        $registrationUserInstance->confirmPassword = htmlspecialchars($_POST['confirmPassword']);

        if (!preg_match(regex::$password, $registrationUserInstance->confirmPassword)) {
            $formError['confirmPassword'] = 'Mot de passe incorrecte';
        }

        if (empty($registrationUserInstance->confirmPassword)) {
            $formError['confirmPassword'] = 'Champs obligatoire';
        }
    }

    //VERIFICATION DE LA CORRESPONDANCE DES PASSWORD
    if (!empty($registrationUserInstance->password) && !empty($registrationUserInstance->confirmPassword)) {
        if ($registrationUserInstance->password === $registrationUserInstance->confirmPassword) {
            $registrationUserInstance->hashedPassword = password_hash($registrationUserInstance->password, PASSWORD_BCRYPT);
        } else {
            $formError['confirmPassword'] = 'Les mots de passe ne correspondent pas ';
        }
    }

    //VERIFICATION DE LA QUANTITE D'ERREUR ET AJOUT A LA BDD
    if (count($formError) == 0) {
        $mailAlreadyExist = $registrationUserInstance->checkIfMailAlreadyExist();
        $usernameAlreadyExist = $registrationUserInstance->checkIfUsernameAlreadyExist();
        if ($mailAlreadyExist == 0 && $usernameAlreadyExist == 0) {
            if ($registrationUserInstance->addUser()) {
                unset($_POST);
                $registrationSuccess = true;
            } else {
                $formError['registration'] = 'L\'inscription à échoué, veuillez recommencer plus tard';
            }
        }
        
        if($mailAlreadyExist == 1 && !isset($formError['mail'])){
            $formError['mail'] = 'Mail déjà utilisé';
        }
        
        if($usernameAlreadyExist == 1 && !isset($formError['username'])){
            $formError['mail'] = 'Nom d\'utilisateur déjà utilisé';
        }
    }
}
