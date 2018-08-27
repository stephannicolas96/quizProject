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

include_once path::getClasses() . 'user.php';

$profileUserInstance = new user();
$userImageExist = null;
$profileErrors = array();

if (!empty($_SESSION)) { //Utilisateur Connecté
    $profileUserInstance->id = $_SESSION['id'];
    $profileUserInstance->getUserByID();
    $userImageExist = file_exists(path::getUserImages() . $profileUserInstance->id . '.png');
} else { //Utilisateur Non Connecté
    header('Location: index.php');
}

if (!empty($_POST)) {
    if (isset($_POST['stopUpdate'])) { //STOP UPDATE
        unset($_POST);
    } else if (isset($_POST['update'])) { //UPDATE USER DATA
        if (isset($_POST['actualPassword'])) {
            $error = helpers::checkInputValue($_POST['actualPassword'], regex::getPassword(), $profileUserInstance->password, 'Password incorrecte');
            if ($error) {
                $profileErrors['actualPassword'] = $error;
            } else {
                if (isset($_POST['username']) && !empty($_POST['username'])) {
                    $error = helpers::checkInputValue($_POST['username'], regex::getUsername(), $profileUserInstance->username, 'Nom d\'utilisateur incorrecte');
                    if ($error) {
                        $profileErrors['username'] = $error;
                    }
                }
                if (isset($_POST['mail']) && !empty($_POST['mail'])) {
                    $error = helpers::checkInputValue($_POST['mail'], regex::getMail(), $profileUserInstance->mail, 'Mail incorrecte');
                    if ($error) {
                        $profileErrors['mail'] = $error;
                    }
                }
                if (isset($_POST['newPassword']) && !empty($_POST['newPassword'])) {
                    $error = helpers::checkInputValue($_POST['newPassword'], regex::getPassword(), $profileUserInstance->confirmPassword, 'New password incorrecte');
                    if ($error) {
                        $profileErrors['newPassword'] = $error;
                    } else {
                        //TODO : update user with new password
                    }
                } else {
                    $profileUserInstance->updateUserWithoutPasswordById();
                }
            }
        }
    } else if (isset($_POST['deleteUserImage'])) { //DELETE USER IMAGE
        // PERMISSION DENIED !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!F
        unlink(path::getUserImages() . $profileUserInstance->id . '.png');
        unset($_POST);
    } else if (isset($_POST['deleteUser'])) { // DELETE USER
        $profileUserInstance->deleteUserById();
        unset($_POST);
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
}