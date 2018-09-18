<?php

/*function generateInput($array) {
    $mainRegex = '/^[\d]+->[\d]+$/';
    $secondRegex = '/^[\d]+->[\d]+[xX][\d]+$/';

    $output = null;
    $mainInput = array_shift($array);
    $secondInput = array_shift($array);

    if (preg_match($mainRegex, $mainInput) && preg_match($secondRegex, $secondInput)) {
        $mainValues = preg_split($splitRegex, $mainInput);
        $secondValues = preg_split($splitRegex, $secondInput);

        $mainAmount = rand($mainValues[0], $mainValues[1]);

        for ($i = 0; $i < $mainAmount; $i++) {
            $addToOutput = null;
            for ($j = 0; $j < $secondValues[2]; $j++) {
                $addToOutput = $addToOutput . ' ' . rand($secondValues[0], $secondValues[1]);
            }
            $output = $output . '|' . trim($addToOutput);
        }
        $output = $mainAmount . $output;
    } else {
        $output = 'error';
    }

    return $output;
}*/

function generateInput($array) {
    $randomBetweenTwoNumber = '/^[\d]+->[\d]+$/';
    $randomBetweenTwoNumberSplitRegex = '/(->)/';
    $randomBetweenTwoNumberMultipleTimes = '/^[\d]+->[\d]+[xX][\d]+$/';
    $randomBetweenTwoNumberMultipleTimesSplitRegex = '/(->|[xX])/';
    $output = null;

    foreach ($array as $lineNumber=>$line) {
        $addToOutput = null;
        if (preg_match($randomBetweenTwoNumber, $line)) {
            $values = preg_split($randomBetweenTwoNumberSplitRegex, $line);
            $addToOutput = rand($values[0], $values[1]);
        } else if (preg_match($randomBetweenTwoNumberMultipleTimes, $line)) {
            $values = preg_split($randomBetweenTwoNumberMultipleTimesSplitRegex, $line);
            for ($i = 0; $i < $values[2]; $i++) {
                $addToOutput = $addToOutput . ' ' . rand($values[0], $values[1]);
            }
        } else {
            $output = 'error on line ' . ($lineNumber + 1) . ' : ' . $line;
            break;
        }
        $output = $output . trim($addToOutput) . '|';
    }
    
    return $output;
}

$input = $_POST['input'];
$numberOfInputToGenerate = $_POST['numberOfInput'];
$input = explode(';', $input);
$input = array_map('trim', $input);
$input = array_filter($input, function($element) {
    return strlen($element) != 0;
});
$output = null;

for ($i = 0; $i < $numberOfInputToGenerate; $i++) {
    echo generateInput($input) . '/';
}


