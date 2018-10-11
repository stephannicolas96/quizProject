<?php

session_start();

include_once '../classes/path.php';
include_once path::getClassesPath() . 'details.php';
include_once path::getClassesPath() . 'score.php';
include_once path::getClassesPath() . 'duel.php';
include_once path::getClassesPath() . 'user.php';

$userInstance = new user();
$duelInstance = new duel();
$scoreInstance = new score();
$detailsInstance = new details();
$success = false;
$errors = array();

if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $detailsInstance->id_user = $scoreInstance->id_user = $duelInstance->id_playerOne = $duelInstance->id_playerTwo = $userInstance->id = htmlspecialchars($_SESSION['id']);
    $user = $userInstance->getUserByID();
    if (is_object($user)) {
        $userInstance->password = $user->password;
        $userInstance->email = $user->email;
        $userInstance->username = $user->username;
    }
} else {
    $errors[] = 'An error occured!'; //TODO TRADUCTION
    echo json_encode(array('errors' => $errors, 'success' => $success));
    exit();
}
if (isset($_POST['submitType'])) {
    $submit = htmlspecialchars($_POST['submitType']);
    if ($submit == 0) { //UPDATE USER DATA
        if (!empty($_POST['username'])) {
            $username = htmlspecialchars($_POST['username']);
            if (strlen($userInstance->username) <= 60 && $userInstance->username != $username) {
                $userInstance->username = $username;
                $usernameAlreadyExist = $userInstance->checkIfUsernameAlreadyExist();
                if ($usernameAlreadyExist) {
                    $errors['username'] = USERNAME_ALREADY_USED;
                }
            }
        } else {
            $errors['username'] = USERNAME_EMPTY;
        }

        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = htmlspecialchars($_POST['email']);
                if (strlen($userInstance->email) <= 60 && $userInstance->email != $email) {
                    $userInstance->email = $email;
                    $mailAlreadyExist = $userInstance->checkIfEmailAlreadyExist();
                    if ($mailAlreadyExist) {
                        $errors['email'] = EMAIL_ALREADY_USED;
                    }
                }
            } else {
                $errors['email'] = EMAIL_INCORRECT;
            }
        } else {
            $errors['email'] = EMAIL_EMPTY;
        }

        if (!empty($_POST['actualPassword'])) { //TODO COMPARE WITH ACTUAL PASSWORD
            $password = htmlspecialchars($_POST['actualPassword']);
            if (!password_verify($password, $userInstance->password)) {
                $errors[] = 'wrong password'; //TODO TRADUCTION
            }
        } else {
            $errors[] = EMPTY_PASSWORD;
        }

        if (!empty($_POST['newPassword'])) {
            $newPassword = password_hash(htmlspecialchars($_POST['newPassword']), PASSWORD_BCRYPT);
        }

        if (count($errors) == 0) {
            if (isset($newPassword)) {
                $userInstance->password = $newPassword;
                $userInstance->updateUserWithPasswordById();
            } else {
                $userInstance->updateUserWithoutPasswordById();
            }
            $success = true;
        }
    } else if ($submit == 1) { // DELETE USER
        try {
            database::getInstance()->beginTransaction();

            $scoreInstance->deleteScoreByUserId();
            $detailsInstance->deleteDetailsByUserId();
            $duelInstance->deleteDuelByUserId();
            $userInstance->deleteUserById();

            database::getInstance()->commit();
            session_unset();
            session_destroy();
            header('Location: home.html');
            $success = true;
        } catch (Exception $ex) {
            database::getInstance()->rollback();
            $errors[] = 'An error occured!'; //TODO TRADUCTION
            echo json_encode(array('errors' => $errors, 'success' => $success));
            exit();
        }
    }
} else {
    $errors[] = 'An error occured!'; //TODO TRADUCTION
}

echo json_encode(array('errors' => $errors, 'success' => $success));

session_write_close();
