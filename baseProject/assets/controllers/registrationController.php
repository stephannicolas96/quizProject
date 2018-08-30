<?php

include_once path::getClasses() . 'user.php';

$registrationUserInstance = new user();

$registrationSuccess = false;
$registrationErrors = array();

if (!empty($_POST) && isset($_POST['register'])) {

    //USERNAME
    if (isset($_POST['username'])) {
        $error = helpers::checkInputValue($_POST['username'], regex::getUsername(),$registrationUserInstance->username,'Nom d\'utilisateur incorrecte');
        if($error)
        {
            $registrationErrors['username'] = $error;
        }
    }

    //MAIL
    if (isset($_POST['mail'])) {
        $error = helpers::checkInputValue($_POST['mail'], regex::getMail(), $registrationUserInstance->mail, 'Mail incorrecte');
        if($error)
        {
            $registrationErrors['mail'] = $error;
        }
    }

    //PASSWORD
    if (isset($_POST['password'])) {
        $error = helpers::checkInputValue($_POST['password'], regex::getPassword(), $registrationUserInstance->password, 'Mot de passe incorrecte');
        if($error)
        {
            $registrationErrors['password'] = $error;
        }
    }

    //CONFIRM PASSWORD
    if (isset($_POST['confirmPassword'])) {
        $error = helpers::checkInputValue($_POST['confirmPassword'], regex::getPassword(),$registrationUserInstance->confirmPassword, 'Mot de passe incorrecte');
        if($error)
        {
            $registrationErrors['confirmPassword'] = $error;
        }
    }

    //VERIFICATION DE LA CORRESPONDANCE DES MOT DE PASSES
    if (!empty($registrationUserInstance->password) && !empty($registrationUserInstance->confirmPassword)) {
        if ($registrationUserInstance->password === $registrationUserInstance->confirmPassword) {
            $registrationUserInstance->hashedPassword = password_hash($registrationUserInstance->password, PASSWORD_BCRYPT);
        } else {
            $registrationErrors['confirmPassword'] = 'Les mots de passe ne correspondent pas';
        }
    }

    //VERIFICATION DE LA QUANTITE D'ERREUR ET AJOUT A LA BDD
    if (count($registrationErrors) == 0) {
        $mailAlreadyExist = $registrationUserInstance->checkIfMailAlreadyExist();
        $usernameAlreadyExist = $registrationUserInstance->checkIfUsernameAlreadyExist();
        if ($mailAlreadyExist == 0 && $usernameAlreadyExist == 0) {
            if ($registrationUserInstance->addUser()) {
                unset($_POST);
                $registrationSuccess = true;
            } else {
                $registrationErrors['registration'] = 'L\'inscription à échoué, veuillez recommencer plus tard';
            }
        }
        
        if($mailAlreadyExist == 1 && !isset($registrationErrors['mail'])){
            $registrationErrors['mail'] = 'Mail déjà utilisé';
        }
        
        if($usernameAlreadyExist == 1 && !isset($registrationErrors['username'])){
            $registrationErrors['username'] = 'Nom d\'utilisateur déjà utilisé';
        }
    }
}
