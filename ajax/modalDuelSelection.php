<?php

//TODO TRANSLATE 
session_start();

include_once '../classes/path.php';
include_once path::getModelsPath() . 'user.php';
include_once path::getModelsPath() . 'langageName.php';
include_once path::getModelsPath() . 'duel.php';
include_once path::getModelsPath() . 'userDuel.php';
include_once path::getModelsPath() . 'question.php';
if (isset($_SESSION['lang'])) {
    include_once path::getLangagePath() . $_SESSION['lang'];
} else {
    exit;
}

$result = array();
$result['success'] = false;
$result['error'] = '';

if (isset($_POST['submitType']) && is_numeric($_POST['submitType'])) {
    $submit = htmlspecialchars($_POST['submitType']);

    if (isset($_POST['langage']) && is_numeric($_POST['langage'])) {
        $langageNameInstance = new langageName();
        $langageId = htmlspecialchars($_POST['langage']);
        if ($langageId == 0) {
            $langageId = $langageNameInstance->getRandomLangage();
        }
        if ($langageId == -1) {
            $result['error'] = 'An error occured try again later!';
        }
    } else {
        $result['error'] = 'An error occured try again later!';
    }

    $userId = -1;
    $userInstance = new user();
    if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
        $userInstance->id = htmlspecialchars($_SESSION['id']);
    } else {
        $result['error'] = 'An error occured try again later!';
    }
    if ($submit == 1) { //SELECT RANDOM OPPONENT
        $userId = $userInstance->getRandomUserId();
            if (!is_numeric($userId) || $userid == -1) {
            $result['error'] = 'An error occured try again later!';
        }
    } else if ($submit == 2) { //SELECT CHOOSEN OPPONENT 
        if (!empty($_POST['opponentUsername'])) {
            $userInstance->username = htmlspecialchars($_POST['opponentUsername']);
            $userId = $userInstance->getUserIdByUsername();
            if (!is_numeric($userId) || $userid == -1) {
                $result['error'] = 'This user doesn\'t exist';
            }
        } else {
            $result['error'] = 'Username can\'t be empty';
        }
    } else {
        $result['error'] = 'An error occured try again later!';
    }


    $questionInstance = new question();
    $questionId = $questionInstance->getRandomQuestionNotCreatedByThePlayers($userInstance->id, $userId);
} else {
    $result['error'] = 'An error occured try again later!';
}

if ($result['error'] == '') {
    try {
        database::getInstance()->beginTransaction();

        $duelInstance = new duel();
        $duelInstance->id_langageName = $langageId;
        $duelInstance->id_question = $questionId;
        $duelInstance->createDuel();
        $duelId = $result['questionId'] = $duelInstance->getLastInsertedId();

        $userDuelInstance = new userDuel();
        $userDuelInstance->id_duelState = 1;
        $userDuelInstance->id_duel = $duelId;
        $userDuelInstance->id_user = $userInstance->id;
        $userDuelInstance->createUserDuel();
        $userDuelInstance->id_user = $userId;
        $userDuelInstance->createUserDuel();

        database::getInstance()->commit();
        $result['success'] = true;
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $result['error'] = 'An error occured try again later!';
        echo json_encode($result);
        exit();
    }
}

echo json_encode($result);

session_write_close();
