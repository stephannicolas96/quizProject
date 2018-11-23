<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';
include_once path::getHelpersPath() . 'inputGenerator.php';

$result = array();

$result['success'] = false;

if (isset($_POST['inputFormat'])) {
    $inputFormat = $_POST['inputFormat'];
    inputGenerator::prepareInputFormat($inputFormat);

    $result['message'] = inputGenerator::generateInput($inputFormat);
    $result['success'] = true;
}

echo json_encode($result);





