<?php

session_start();

include_once '../classes/path.php';
include_once path::getModelsPath() . 'score.php';
include_once path::getModelsPath() . 'userDuel.php';
include_once path::getModelsPath() . 'user.php';
include_once path::getLangagePath() . $_SESSION['lang'];

$userInstance = new user();
$scoreInstance = new score();
$userDuelInstance = new userDuel();
$success = false;
$errors = array();

if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $scoreInstance->id_user = $userDuelInstance->id_user = $userInstance->id = htmlspecialchars($_SESSION['id']);
    if (!$userInstance->getUserByID()) {
        $errors[] = TRY_AGAIN_LATER;
    }
} else {
    $errors[] = TRY_AGAIN_LATER;
    echo json_encode(array('errors' => $errors, 'success' => $success));
    exit();
}
if (isset($_POST['submitType']) && is_numeric($_POST['submitType'])) {
    $submit = htmlspecialchars($_POST['submitType']);
    if ($submit == 0) { //UPDATE USER DATA
        if (!empty($_POST['username'])) {
            $result = inputChecker::checkInput($_POST['username'], $userInstance->username, function($valueToCheck) {
                        return preg_match(regex::getUsernameRegex(), $valueToCheck) && strlen($valueToCheck) <= 255;
                    }, USERNAME_INCORRECT, function($valueToCheck) {
                        $returnValue = true;
                        if (isset($_SESSION['username']) && strtolower($_SESSION['username']) == strtolower($valueToCheck)) {
                            $returnValue = false;
                        } else {
                            $returnValue = user::checkIfUsernameAlreadyExist($valueToCheck);
                        }
                        return $returnValue;
                    }, USERNAME_ALREADY_USED);

            if ($result != '')
                $errors['username'] = $result;
        } else {
            $errors['username'] = USERNAME_EMPTY;
        }

        if (!empty($_POST['email'])) {
            $result = inputChecker::checkInput($_POST['email'], $userInstance->email, function($valueToCheck) {
                        return filter_var($valueToCheck, FILTER_VALIDATE_EMAIL) && strlen($valueToCheck) <= 255;
                    }, EMAIL_INCORRECT, function($valueToCheck) {
                        $returnValue = true;
                        if (isset($_SESSION['email']) && strtolower($_SESSION['email']) == strtolower($valueToCheck)) {
                            $returnValue = false;
                        } else {
                            $returnValue = user::checkIfEmailAlreadyExist($valueToCheck);
                        }
                        return $returnValue;
                    }, EMAIL_ALREADY_USED);

            if ($result != '')
                $errors['email'] = $result;
        } else {
            $errors['email'] = EMAIL_EMPTY;
        }

        if (!empty($_POST['actualPassword'])) {
            if (!password_verify($_POST['actualPassword'], $userInstance->password)) {
                $errors[] = WRONG_PASSWORD;
            }
        } else {
            $errors[] = WRONG_PASSWORD;
        }

        if (!empty($_POST['newPassword'])) {
            $newPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
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
            $userDuelInstance->replaceAllUserDuelUserIdWithTheFirstUserId();
            $userInstance->deleteUserById();

            database::getInstance()->commit();
            session_destroy();
            $success = true;
        } catch (Exception $ex) {
            database::getInstance()->rollback();
            $errors[] = TRY_AGAIN_LATER;
            echo json_encode(array('errors' => $errors, 'success' => $success));
            exit();
        }
    }
} else {
    $errors[] = TRY_AGAIN_LATER;
}

echo json_encode(array('errors' => $errors, 'success' => $success));

session_write_close();
