<?php

session_start();
include_once '../classes/path.php';
include_once path::getModelsPath() . 'user.php';
include_once path::getModelsPath() . 'score.php';
include_once path::getLangagePath() . $_SESSION['lang'];

$userInstance = new user();
$scoreInstance = new score();
$errors = array();
$success = false;
$usernameAlreadyExist = null;
$mailAlreadyExist = null;
$hashedPassword = null;

//USERNAME
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

//EMAIL
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

//PASSWORD
if (!empty($_POST['registrationPassword'])) {
    $userInstance->password = password_hash($_POST['registrationPassword'], PASSWORD_BCRYPT);
} else {
    $errors[] = EMPTY_PASSWORD;
}

if (count($errors) == 0) {
    try {
        database::getInstance()->beginTransaction();

        $userInstance->addUser();
        $scoreInstance->addBaseScoreToLastUser();

        database::getInstance()->commit();
        $success = true;
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $errors[] = REGISTRATION_FAILED;
        echo json_encode(array('errors' => $errors, 'success' => $success));
        exit();
    }
}

echo json_encode(array('errors' => $errors, 'success' => $success));

session_write_close();
