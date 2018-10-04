<?php

include 'compiler.php';
include 'inputGenerator.php';

$result = array();

//------------------------------------ QUESTION ------------------------------------//

$regexQuestion = '/(Énoncé|Enunciated)\b.*?\b(Entrée|Input)\b.*?\b(Sortie|Output)/ms';

if (isset($_POST['question'])) {
    $question = htmlspecialchars($_POST['question']);
    if (!preg_match($regexInputOuput, $question)) {
        $result['success'] = false;
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
        $generatedInputs[] = generateInput($input);
    }
} else {
    $result['success'] = false;
}

//------------------------------------ CODE ------------------------------------//

if (isset($_POST['mode'])) {
    $mode = htmlspecialchars($_POST['mode']);
}
if (isset($_POST['code'])) {
    $userInput = $_POST['code']; // SECURE THIS 
}

if (isset($generatedInputs)) {
    
}

$outputs = array();
foreach ($testCases as $testCase) {
    
}
print_r($outputs);

/**
 * Return current timestamp to create a unique filename.
 * @param string $extension
 * @return string
 */
function getFileName($extension) {
    $date = new DateTime();
    return $date->getTimestamp() . '.' . $extension;
}
