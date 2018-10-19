<?php
include_once path::getModelsPath() . 'langageName.php';

$langageNameInstance = new langageName();

$currentLangage = 1;
if (isset($_GET['langage'])) {
    $currentLangage = htmlspecialchars($_GET['langage']);
}

$allLangages = $langageNameInstance->getAllLangages();