<?php

session_start();

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';
include_once path::getHelpersPath() . 'compiler.php';
include_once path::getHelpersPath() . 'inputGenerator.php';
include_once path::getModelsPath() . 'question.php';
include_once path::getModelsPath() . 'testCase.php';
if (isset($_SESSION['lang'])) {
    include_once path::getLangagePath() . $_SESSION['lang'];
} else {
    exit;
}

$result = array();

$result['success'] = 1;
$result['message'] = QUESTION_REGISTRATION_SUCCESS;

$result['outputs'] = array();

//------------------------------------ QUESTION ------------------------------------//
//check if the question contains the correct information and prepare
//the data for the database

if (!empty($_POST['question'])) {
    $question = htmlspecialchars($_POST['question']);
    if (!preg_match(regex::QUESTION_CONTAINS, $question)) {
        $result['success'] = -1;
        $result['message'] = REQUESTED_TERMS;
    } else {
        $questionData = preg_split(regex::QUESTION_SPLIT, $question);
        array_shift($questionData);
        $questionData = array_map('trim', $questionData);
    }
} else {
    $result['success'] = -1;
    $result['message'] = EMPTY_QUESTION;
}

//------------------------------------ INPUT ------------------------------------//
//prepare the inputFormat and generate a number of real input to
//store them in the database

if ($result['success'] == 1) {
    if (!empty($_POST['inputFormat'])) { // INPUT FORMAT WRITTEN INSIDE THE INPUT EDITOR
        $inputFormat = $_POST['inputFormat'];
        inputGenerator::prepareInputFormat($inputFormat);
    } else {
        $result['success'] = -2;
        $result['message'] = EMPTY_INPUT;
    }

    $generatedInputs = array();
    if (isset($_POST['numberOfInputToGenerate']) && isset($inputFormat)) { //get the amount of input to generate
        $numberOfInputToGenerate = htmlspecialchars($_POST['numberOfInputToGenerate']);
        for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
            $generatedInputs[] = inputGenerator::generateInput($inputFormat);   //generate input 
        }
    }

    if (count($generatedInputs) > 0) { // if the inputs are generated correctly we check for error in each input
        foreach ($generatedInputs as $input) {
            if (preg_match(regex::INPUT_GENERATION_ERROR, $input)) {
                $result['success'] = -2;
                $result['message'] = PROBLEM_GENERATING_INPUT;
            }
        }
    } else {
        $result['success'] = -2;
        $result['message'] = PROBLEM_GENERATING_INPUT;
    }
}

//------------------------------------ USER CODE ------------------------------------//
//check the user code and compile it if needed to generate the output
//based on the inputs generated above

if ($result['success'] == 1) {
    if (!empty($_POST['langage'])) {
        $langage = htmlspecialchars($_POST['langage']);
    } else {
        $result['success'] = -3;
        $result['message'] = TRY_AGAIN_LATER;
    }
    if (!empty($_POST['userCode'])) {
        $userCode = $_POST['userCode']; // TODO SECURE THIS 
    } else {
        $result['success'] = -3;
        $result['message'] = EMPTY_CODE;
    }

    $outputs = array();
    if (count($generatedInputs) > 0) { //if any inputs were generated try and generate outputs
        foreach ($generatedInputs as $input) {
            $result['outputs'][] = $outputs[] = compiler::compile($input, $langage, $userCode);
        }
    } else {
        $result['success'] = -3;
        $result['message'] = PROBLEM_GENERATING_OUTPUT;
    }

    if (count($outputs) > 0) { //if any outputs were generated we check for any error in each output
        foreach ($outputs as $output) {
            if (isset($output['executionOutput']) && preg_match(regex::OUTPUT_GENERATION_ERROR, $output['executionOutput'])) {
                $result['success'] = -3;
                $result['message'] = PROBLEM_GENERATING_OUTPUT;
            }
            if (isset($output['compilationOutput']) && preg_match(regex::OUTPUT_GENERATION_ERROR, $output['compilationOutput'])) {
                $result['success'] = -3;
                $result['message'] = PROBLEM_GENERATING_OUTPUT;
            }
        }
    } else {
        $result['success'] = -3;
        $result['message'] = PROBLEM_GENERATING_OUTPUT;
    }
}

if ($result['success'] == 1) {
    try {
        $questionInstance = new question();
        $testCaseInstance = new testCase();

        //use a transaction to add the question and all the testCases that correspond to this question to ensure that everything is added
        //and if any error occur just rolback
        //this way we are sure that each question will have every testCases linked correctly and we won't have a question without testCases
        database::getInstance()->beginTransaction();

        $questionInstance->enunciated = $questionData[0];
        $questionInstance->input = $questionData[1];
        $questionInstance->output = $questionData[2];
        $questionInstance->difficulty = 0;
        $questionInstance->id_user = (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) ? $_SESSION['id'] : 0;
        $questionInstance->createQuestion();
        $testCaseInstance->id_question = $questionInstance->getLastInsertedId();

        for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
            $testCaseInstance->input = $generatedInputs[$i];
            $testCaseInstance->output = $outputs[$i]['executionOutput'];
            $testCaseInstance->createTestCase();
        }

        database::getInstance()->commit();
    } catch (Exception $ex) {
        database::getInstance()->rollback();
        $result['success'] = -4;
        $result['message'] = PROBLEM_REGISTRATING_QUESTION;
    }
}
echo json_encode($result);

session_write_close();

