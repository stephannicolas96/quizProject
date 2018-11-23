<?php

session_start();

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';
include_once path::getModelsPath() . 'testCase.php';
include_once path::getModelsPath() . 'userDuel.php';
include_once path::getHelpersPath() . 'compiler.php';
if (isset($_SESSION['lang'])) {
    include_once path::getLangagePath() . $_SESSION['lang'];
} else {
    exit;
}

set_time_limit(11);

$result = array();
$result['success'] = false;
$result['output'] = array();

$testCases = array();
if (!empty($_SESSION['questionId']) && is_numeric($_SESSION['questionId'])) {
    $testCaseInstance = new testCase();
    $testCaseInstance->id_question = intval($_SESSION['questionId']);
    $testCases = $testCaseInstance->getAllTestCases();
}
$langage = (isset($_POST['langage'])) ? $_POST['langage'] : -1;
$userCode = (isset($_POST['code'])) ? $_POST['code'] : '';

if ($langage != -1 && $userCode != '') {
    $numberOfGoodResult = 0;
    $cumulatedTime = 0;
    foreach ($testCases as $testCase) {

        $startTime = microtime(true);
        $output = compiler::compile($testCase->input, $langage, $userCode);
        $endTime = microtime(true);

        $cumulatedTime = $endTime - $startTime;

        $result['output'][] = $output;
        $lastId = count($result['output']) - 1;
        if (isset($output['executionOutput']) && trim($output['executionOutput']) == $testCase->output) {
            $numberOfGoodResult++;
            $result['output'][$lastId]['success'] = true;
        } else if (!preg_match(regex::OUTPUT_GENERATION_ERROR, $result['output'][$lastId]['executionOutput'])) {
            $result['output'][$lastId]['executionOutput'] = 'Your output is : ' . htmlspecialchars($result['output'][$lastId]['executionOutput']) . '<br/>Expected was : ' . $testCase->output;
        }
    }

    $meanExecutionTime = round($cumulatedTime / 20 * 1000);
    $result['executionTime'] = 'Your code executed in : ' . $meanExecutionTime . ' ms';

    if ($numberOfGoodResult == count($testCases)) {
        try {
            database::getInstance()->beginTransaction();

            $userDuel = new userDuel();
            $userDuel->id_user = (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) ? $_SESSION['id'] : 0;
            $userDuel->id_duel = (isset($_SESSION['duelId']) && is_numeric($_SESSION['duelId'])) ? $_SESSION['duelId'] : 0;
            $userDuel->endTime = new DateTime();
            $userDuel->endTime = $userDuel->endTime->format('Y-m-d H:i:s');
            $userDuel->executionTime = $meanExecutionTime;
            $userDuel->updateUserDuelByDuelIdAndUserId('waiting');

            if ($userDuel->isDuelOver()) {
                $ids = $userDuel->getUsersId();
                if (count($ids) == 2) {
                    $userDuel->endDuel($ids[0]->id_user, $ids[1]->id_user);
                }
            }

            database::getInstance()->commit();
            $result['success'] = true;
            $result['successMessage'] = GOOD_ANSWER;
        } catch (Exception $ex) {
            database::getInstance()->rollback();
            $result['error'] = TRY_AGAIN_LATER;
            echo json_encode($result);
            exit();
        }
    }
}

echo json_encode($result);

session_write_close();