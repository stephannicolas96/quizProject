<?php

/**
 * Transform each row of the input into a real input following some rules:
 * (int)->(int); => random in the range of the two numbers
 * (int)->(int)x(int); => random in the range of the two number repeated x times
 * @param string $array
 * @return string
 */
function generateInput($array) {
    $randomBetweenTwoNumber = '/^[\d]+->[\d]+$/';
    $randomBetweenTwoNumberSplitRegex = '/(->)/';
    $randomBetweenTwoNumberMultipleTimes = '/^[\d]+->[\d]+[xX][\d]+$/';
    $randomBetweenTwoNumberMultipleTimesSplitRegex = '/(->|[xX])/';
    $output = null;
    foreach ($array as $lineNumber => $line) {
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
