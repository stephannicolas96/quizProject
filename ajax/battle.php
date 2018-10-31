<?php

session_start();

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';
include_once path::getModelsPath() . 'testCase.php';
include_once path::getHelpersPath() . 'compiler.php';

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
        } else if (!preg_match(regex::getOutputGenerationErrorRegex(), $result['output'][$lastId]['executionOutput'])) {
            $result['output'][$lastId]['executionOutput'] = 'Your output is : ' . $result['output'][$lastId]['executionOutput'] . '<br/>Expected was : ' . $testCase->output;
        }
    }

    $result['executionTime'] = 'Your code executed in : ' . round($cumulatedTime / 20 * 1000) . ' ms';

    if ($numberOfGoodResult == count($testCases)) {
        $result['success'] = true;
    }
}

echo json_encode($result);

session_write_close();


// TODO ADD ENDTIME AND EXECUTIONTIME TO DB FOR EACH USER AND WHEN THERE IS A WINNER INCREASE HIS SCORE AND DECREASE THE OPPONENT ONE