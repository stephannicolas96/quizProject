<?php

session_start();

include_once '../classes/path.php';
include_once path::getModelsPath() . 'user.php';
include_once path::getModelsPath() . 'langageName.php';
include_once path::getModelsPath() . 'duel.php';
include_once path::getModelsPath() . 'userDuel.php';
include_once path::getModelsPath() . 'question.php';

$result = array();
$result['success'] = false;
$result['errors'] = array();

if (isset($_POST['submitType']) && is_numeric($_POST['submitType'])) {
    $submit = htmlspecialchars($_POST['submitType']);

    if (isset($_POST['langage']) && is_numeric($_POST['langage'])) {
        $langageNameInstance = new langageName();
        $langageId = htmlspecialchars($_POST['langage']);
        if ($langageId == 0) {
            $langageId = $langageNameInstance->getRandomLangage();
        }
        if (is_null($langageId)) {
            // ERROR
        }
    } else {
        // ERROR
    }

    $userId = -1;
    $userInstance = new user();
    if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
        $userInstance->id = htmlspecialchars($_SESSION['id']);
    } else {
        //ERROR 
    }
    if ($submit == 1) { //SELECT RANDOM OPPONENT
        $userId = $userInstance->getRandomUserId();
    } else if ($submit == 2) { //SELECT CHOOSEN OPPONENT 
        if (!empty($_POST['opponentUsername'])) {
            $userInstance->username = htmlspecialchars($_POST['opponentUsername']);
            $userId = $userInstance->getUserIdByUsername();
        } else {
            // ERROR
        }
    } else {
        // ERROR
    }

    if (is_null($userId) || $userId == -1) {
        //ERROR 
    }

    $questionInstance = new question();
    $questionId = $questionInstance->getRandomQuestionNotCreatedByThePlayers($userInstance->id, $userId);
} else {
    // ERROR
}

if (count($result['errors']) == 0) {
    try {
        database::getInstance()->beginTransaction();

        $duelInstance = new duel();
        $duelInstance->id_langageName = $langageId;
        $duelInstance->id_question = $questionId;
        $duelInstance->createDuel();
        $duelId = $duelInstance->getLastInsertedId();

        $userDuelInstance = new userDuel();
        $userDuelInstance->id_duelState = 5;
        $userDuelInstance->id_duel = $duelId;
        $userDuelInstance->id_user = $userInstance->id;
        $userDuelInstance->createUserDuel();
        $userDuelInstance->id_user = $userId;
        $userDuelInstance->createUserDuel();

        database::getInstance()->commit();
        $result['success'] = true;
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $result['errors'][] = 'An error occured!'; //TODO TRADUCTION
        echo json_encode($result);
        exit();
    }
}

echo json_encode($result);

session_write_close();
