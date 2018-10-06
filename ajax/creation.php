<?php

include_once '../classes/path.php';
include 'compiler.php';
include 'inputGenerator.php';
include path::getClassesPath() . 'question.php';
include path::getClassesPath() . 'testCase.php';

$result = array();

$result['success'] = true;

//------------------------------------ QUESTION ------------------------------------//

$regexQuestion = '/(Énoncé|Enunciated)\b.*?\b(Entrée|Input)\b.*?\b(Sortie|Output)/ms';
$regexSplitQuestion = '/(Énoncé|Enunciated|Entrée|Input|Sortie|Output)/ms';
if (isset($_POST['question'])) {
    $question = htmlspecialchars($_POST['question']);
    if (!preg_match($regexQuestion, $question)) {
        $result['success'] = false;
    } else {
        $questionData = preg_split($regexSplitQuestion, $question);
        array_shift($questionData);
        $questionData = array_map('trim', $questionData);
    }
} else {
    $result['success'] = false;
}

//------------------------------------ INPUT ------------------------------------//

if (isset($_POST['inputFormat'])) { // INPUT FORMAT WRITTEN INSIDE THE INPUT EDITOR
    $inputFormat = htmlspecialchars($_POST['inputFormat']);
    $inputFormat = str_replace('&gt;', '>', $inputFormat);
    $inputFormat = explode(';', $inputFormat);
    $inputFormat = array_map('trim', $inputFormat);
    $inputFormat = array_filter($inputFormat, function($element) {
        return strlen($element) != 0;
    });
} else {
    $result['success'] = false;
}

if (isset($_POST['numberOfInputToGenerate']) && isset($inputFormat)) { //AMOUNT OF INPUT TO GENERATE
    $numberOfInputToGenerate = htmlspecialchars($_POST['numberOfInputToGenerate']);
    $generatedInputs = array();
    for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
        $generatedInputs[] = generateInput($inputFormat);
    }
} else {
    $result['success'] = false;
}

//------------------------------------ USER CODE ------------------------------------//

if (isset($_POST['langage'])) {
    $langage = htmlspecialchars($_POST['langage']);
}
if (isset($_POST['userCode'])) {
    $userCode = $_POST['userCode']; // SECURE THIS 
}

$outputs = array();
if (isset($generatedInputs)) {
    foreach ($generatedInputs as $input) {
        $outputs[] = compile($input, $langage, $userCode);
    }
}

$regex = '/.+(\/temp|tmp).+/'; // TODO ADD TO REGEX CLASSES
foreach ($outputs as $output) {
    if (isset($output['executionOutput']) && preg_match($regex, $output['executionOutput'])) {
        $result['success'] = false;
    }
    if (isset($output['compilationOutput']) && preg_match($regex, $output['compilationOutput'])) {
        $result['success'] = false;
    }
}

if ($result['success']) {
    try {
        $questionInstance = new question();
        $testCaseInstance = new testCase();

        database::getInstance()->beginTransaction();

        $questionInstance->enunciated = $questionData[0];
        $questionInstance->input = $questionData[1];
        $questionInstance->output = $questionData[2];
        $questionInstance->difficulty = 0;
        $questionInstance->createQuestion();
        $testCaseInstance->id_question = $questionInstance->getLastQuestionId()->id;

        for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
            $testCaseInstance->input = $generatedInputs[$i];
            $testCaseInstance->output = $outputs[$i]['executionOutput'];
            $testCaseInstance->createTestCase();
        }

        database::getInstance()->commit();
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $result['success'] = false;
    }
}
echo json_encode($result);
