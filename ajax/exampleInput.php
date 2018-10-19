<?php

include_once '../classes/path.php';
include path::getHelpersPath() . 'inputGenerator.php';

$result = array();

$result['success'] = false;

if (isset($_POST['inputFormat'])) {
    $inputFormat = htmlspecialchars($_POST['inputFormat']);
    $inputFormat = str_replace('&gt;', '>', $inputFormat);
    $inputFormat = explode(';', $inputFormat);
    $inputFormat = array_map('trim', $inputFormat);
    $inputFormat = array_filter($inputFormat, function($element) {
        return strlen($element) != 0;
    });

    $result['message'] = inputGenerator::generateInput($inputFormat);
    $result['success'] = true;
}

echo json_encode($result);





