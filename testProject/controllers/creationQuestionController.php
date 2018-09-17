<?php

$regexInputOuput = '/(Entrée|Input)\b.*?\b(Sortie|Output)/ms';

$input = $_POST['input'];

if(preg_match($regexInputOuput, $input)){
    echo 1;
} else {
    echo 0;
}
