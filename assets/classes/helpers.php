<?php

class helpers {

    /**
     * Permet de s'assurer que l'input ne soit pas vide et bien de la forme attendu et de retourner un message adéquat.
     * @param $inputValue input a vérifier
     * @param $regex utilisé pour tester $inputValue
     * @param $outputValue prend la valeur de $inputValue si tout les tests sont passé
     * @param $messageOnRegexFail retourné si le pattern de $regex n'est pas présent dans $inputValue 
     * @param $messageOnEmptyInput retourné lorsque $inputValue est vide
     */
    public static function checkInputValue($inputValue, $regex, &$outputValue, $messageOnRegexFail = 'Champs incorrecte', $messageOnEmptyInput = 'Champs obligatoire') {
        $outputMessage = null;

        $result = self::checkInputEmptyAndRegex($inputValue, $regex, $outputValue);

        if ($result == -1) {
            $outputMessage = $messageOnRegexFail;
        } else if ($result == 0) {
            $outputMessage = $messageOnEmptyInput;
        }

        return $outputMessage;
    }

    /**
     * 
     * @param type $inputValue input a vérifier
     * @param type $regex utilisé pour tester $inputValue
     * @param type $outputValue prend la valeur de $inputValue si tout les tests sont passé
     * @return int (-1 = regexFail, 0 = $inputValue empty, 1 = tout est OK)
     */
    public static function checkInputEmptyAndRegex($inputValue, $regex, &$outputValue) {
        $value = htmlspecialchars($inputValue);
        $returnValue;

        if (isset($value) && !empty($value)) {
            if (preg_match($regex, $value)) {
                $outputValue = $value;
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        } else {
            $returnValue = 0;
        }

        return $returnValue;
    }
}
