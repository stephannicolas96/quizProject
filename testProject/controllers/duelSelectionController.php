<?php

include_once path::getClassesPath() . 'duel.php';

$duelInstance = new duel;

var_dump($_POST);

if (isset($_POST['randomOpponent'])) {
    unset($_POST['randomOpponent']);

    
} else if (isset($_POST['chosenOpponent'])) {
    unset($_POST['chosenOpponent']);

   
}


function checkScriptingLanguage()
{
     if(isset($_POST['scriptingLanguage']))
    {
        
    }
    unset($_POST['scriptingLanguage']);
}