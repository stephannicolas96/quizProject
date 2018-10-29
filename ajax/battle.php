<?php

session_start();

include_once '../classes/path.php';
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
$langage = $_POST['langage']; // SECURE THIS
$userCode = $_POST['code']; // SECURE THIS 

$numberOfGoodResult = 0;
foreach ($testCases as $testCase) {
    
    $output = compiler::compile($testCase->input, $langage, $userCode);
    $result['output'][] = $output;
    if (isset($output['executionOutput']) && trim($output['executionOutput']) == $testCase->output) {
       $numberOfGoodResult++;
    }
}

if($numberOfGoodResult == count($testCases)){
    $result['success'] = true;
}

echo json_encode($result);

session_write_close();
