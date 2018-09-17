<?php
function generateInput($array) {
    $mainRegex = '/^[\d]+->[\d]+$/';
    $secondRegex = '/^[\d]+->[\d]+[xX][\d]+$/';
    $splitRegex = '/(->|[xX])/';
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
        return 'error';
    }

    return $output;
}

$input = $_POST['input'];

$input = explode(';', $input);
$input = array_map('trim', $input);
$input = array_filter($input, function($element) {
    return strlen($element) != 0;
});
$output = null;
for ($i = 0; $i < 20; $i++) {
    echo generateInput($input) . '/';
}


