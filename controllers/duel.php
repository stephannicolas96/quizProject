<?php

session_start();

include_once path::getModelsPath() . 'duel.php';
include_once path::getModelsPath() . 'question.php';

if (isset($_GET['duelId']) && is_numeric($_GET['duelId'])) {
    $duelId = htmlspecialchars($_GET['duelId']);
}
$userId = 0;
if (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) {
    $userId = htmlspecialchars($_SESSION['id']);
}

if (isset($duelId) && isset($userId)) { //If we have an user and an duelId we can try to process the data
    $duelInstance = new duel();
    $duelInstance->id = $duelId;
    if ($duelInstance->getDuelData()) { //If we get all duel data, we try to get question data linked to the duel
        $langageId = $duelInstance->id_langageName;
        $questionInstance = new question();
        $questionInstance->id = $duelInstance->id_question;
        if ($questionInstance->getQuestion()) { //If we get all question data, we save the id for later when the user will process is 'code'
            $_SESSION['questionId'] = $questionInstance->id;
        } else {
            //ERROR
        }
    } else {
        //ERROR
    }
}

if (!$duelInstance->checkIfUserParticipateInTheDuel($userId)) { //If the user isn't participating in this battle we redirect him to the home page
    header('Location: home.html');
}

session_write_close();
