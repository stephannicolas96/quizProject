<?php

class inputChecker {

    /**
     * 
     * @param type $valueToCheck
     * @param type $outputValue
     * @param callable $checkIfValueIsCorrect
     * @param type $errorOnIncorrectValue
     * @param callable $secondCheck
     * @param type $errorOnValueAlreadyUsed
     * @return type
     */
    public static function checkInput($valueToCheck, &$outputValue, callable $checkIfValueIsCorrect = null, $errorOnIncorrectValue = '', callable $secondCheck = null, $errorOnValueAlreadyUsed = '') {
        $ouputMessage = '';

        $valueToCheck = htmlspecialchars($valueToCheck);
        if (is_callable($checkIfValueIsCorrect) && $checkIfValueIsCorrect($valueToCheck)) {
            $outputValue = $valueToCheck;
            if (is_callable($secondCheck) && $secondCheck($valueToCheck)) {
                $ouputMessage = $errorOnValueAlreadyUsed;
            }
        } else {
            $ouputMessage = $errorOnIncorrectValue;
        }

        return $ouputMessage;
    }

}
