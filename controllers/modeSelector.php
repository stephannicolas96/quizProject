<?php
include_once path::getClassesPath() . 'langageType.php';

$langageTypeInstance = new langageType();

$currentType = 1;
if (isset($_GET['type'])) {
    $currentType = htmlspecialchars($_GET['type']);
}

$allTypes = $langageTypeInstance->getAllTypes();