<?php

include_once '../classes/path.php';
include 'compiler.php';
include 'inputGenerator.php';
include path::getClassesPath() . 'question.php';
include path::getClassesPath() . 'testCase.php';

$result = array();

$result['success'] = 1;

//------------------------------------ QUESTION ------------------------------------//

$regexQuestion = '/(Énoncé|Enunciated)\b.*?\b(Entrée|Input)\b.*?\b(Sortie|Output)/ms';
$regexSplitQuestion = '/(Énoncé|Enunciated|Entrée|Input|Sortie|Output)/ms';
if (!empty($_POST['question'])) {
    $question = htmlspecialchars($_POST['question']);
    if (!preg_match($regexQuestion, $question)) {
        $result['success'] = -1;
        $result['message'] = 'Your question doesn\'t contains all the requested words refer to the information';
    } else {
        $questionData = preg_split($regexSplitQuestion, $question);
        array_shift($questionData);
        $questionData = array_map('trim', $questionData);
    }
} else {
    $result['success'] = -1;
    $result['message'] = 'Your question can\'t be empty';
}

//------------------------------------ INPUT ------------------------------------//

if ($result['success'] == 1) {
    if (!empty($_POST['inputFormat'])) { // INPUT FORMAT WRITTEN INSIDE THE INPUT EDITOR
        $inputFormat = htmlspecialchars($_POST['inputFormat']);
        $inputFormat = str_replace('&gt;', '>', $inputFormat);
        $inputFormat = explode(';', $inputFormat);
        $inputFormat = array_map('trim', $inputFormat);
        $inputFormat = array_filter($inputFormat, function($element) {
            return strlen($element) != 0;
        });
    } else {
        $result['success'] = -2;
        $result['message'] = 'Your input can\'t be empty';
    }

    $generatedInputs = array();
    if (isset($_POST['numberOfInputToGenerate']) && isset($inputFormat)) { //AMOUNT OF INPUT TO GENERATE
        $numberOfInputToGenerate = htmlspecialchars($_POST['numberOfInputToGenerate']);
        for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
            $generatedInputs[] = generateInput($inputFormat);
        }
    }

    $regex = '/error.+/'; // TODO ADD TO REGEX CLASSES
    if (count($generatedInputs) > 0) {
        foreach ($generatedInputs as $input) {
            if (preg_match($regex, $input)) {
                $result['success'] = -2;
                $result['message'] = 'There was a problem generating inputs';
            }
        }
    } else {
        $result['success'] = -2;
        $result['message'] = 'There was a problem generating inputs';
    }
}

//------------------------------------ USER CODE ------------------------------------//

if ($result['success'] == 1) {
    if (!empty($_POST['langage'])) {
        $langage = htmlspecialchars($_POST['langage']);
    } else {
        $result['success'] = -3;
        $result['message'] = 'Try again later...';
    }
    if (!empty($_POST['userCode'])) {
        $userCode = $_POST['userCode']; // TODO SECURE THIS 
    } else {
        $result['success'] = -3;
        $result['message'] = 'Your code can\'t be empty';
    }

    $outputs = array();
    if (count($generatedInputs) > 0) {
        foreach ($generatedInputs as $input) {
            $outputs[] = compile($input, $langage, $userCode);
        }
    } else {
        $result['success'] = -2;
        $result['message'] = 'There was a problem generating inputs';
    }

    $regex = '/.+(\/temp|tmp).+/'; // TODO ADD TO REGEX CLASSES
    if (count($outputs) > 0) {
        foreach ($outputs as $output) {
            if (isset($output['executionOutput']) && preg_match($regex, $output['executionOutput'])) {
                $result['success'] = -3;
                $result['message'] = 'There was a problem generating outputs';
            }
            if (isset($output['compilationOutput']) && preg_match($regex, $output['compilationOutput'])) {
                $result['success'] = -3;
                $result['message'] = 'There was a problem generating outputs';
            }
        }
    } else {
        $result['success'] = -3;
        $result['message'] = 'There was a problem generating outputs';
    }
}

if ($result['success'] == 1) {
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
        $result['message'] = 'Question successfully registered!';
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $result['success'] = -4;
        $result['message'] = 'There was a problem registrating your question, try again later...';
    }
}
echo json_encode($result);
