<?php 

include_once '../classes/path.php';
include_once path::getClassesPath() . 'testCase.php';

$testCaseInstance = new testCase();
$testCaseInstance->getAllTestCases(2);

$mode = $_POST['mode']; // SECURE THIS
$userCode = $_POST['code']; // SECURE THIS 

foreach ($testCases as $testCase) {

    if (trim($executionOutput) != $testCase['output']) {
        echo 'NONNNNNNNNNN';
        print_r($compilationOutput);
        print_r($executionOutput);
        print_r($testCase['output']);
        exit;
    }
}

