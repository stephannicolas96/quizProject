<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'regex.php';

class inputGenerator {

    /**
     * Transform each line of the input into a real input following some rules:
     * (int)->(int); => random in the range of the two numbers
     * (int)->(int)*(int); => random in the range of the two number repeated x times separated by a space
     * (char)->(char); => random letter in the range (Case Sensitive)
     * (char)->(char)*(int); => random letter in the range (Case Sensistive) repeated x times to form a string
     * ()->()/()->()*()/()->() => a single row can contain multiple pattern to allow input diversity
     * ()->()/()->()*()~(int)->(int) => use the last part of the pattern ~()->() to repeat the row x times
     * @param string $array
     * @return string
     */
    public static function generateInput($array) {

        $output = array();
        foreach ($array as $lineNumber => $line) {
            if (preg_match(regex::INPUT_GENERATION_LINE, $line)) { //$line is a line inside the input editor
                $repeatLine = preg_split(regex::INPUT_GENERATION_REPEAT_LINE_SPLIT, $line);
                $repeatTimes = 1;
                if (count($repeatLine) > 1) {
                    $data = preg_split(regex::INPUT_GENERATION_PATTERN_PART_SPLIT, $repeatLine[1]);
                    $repeatTimes = rand($data[0], $data[1]);
                    $groups = preg_split(regex::INPUT_GENERATION_PATTERN_SPLIT, $repeatLine[0]);
                } else {
                    $groups = preg_split(regex::INPUT_GENERATION_PATTERN_SPLIT, $line);
                }
                for ($j = 0; $j < $repeatTimes; $j++) {
                    $lineOutput = array();
                    foreach ($groups as $group) { //$groups are separated by '/' inside the input editor
                        $groupOutput = array();
                        $data = preg_split(regex::INPUT_GENERATION_PATTERN_PART_SPLIT, $group);

                        if (is_numeric($data[0])) {
                            $multiplier = (isset($data[2])) ? $data[2] : 1;
                            for ($i = 0; $i < $multiplier; $i++) { //each value represent a group in the line
                                $lineOutput[] = rand($data[0], $data[1]);
                            }
                        } else {
                            $aUC = 65;
                            $zUC = 90;
                            $aLC = 97;
                            $zLC = 122;
                            $startAt = ord($data[0]);
                            $endAt = ord($data[1]);
                            $multiplier = (isset($data[2])) ? $data[2] : 1;
                            $startIsInUC = $startAt >= $aUC && $startAt <= $zUC;
                            $endIsInUC = $endAt >= $aUC && $endAt <= $zUC;
                            $startIsInLC = $startAt >= $aLC && $startAt <= $zLC;
                            $endIsInLC = $endAt >= $aLC && $endAt <= $zLC;
                            if ($startIsInUC && $endIsInUC || $startIsInLC && $endIsInLC) {
                                for ($i = 0; $i < $multiplier; $i++) { //each value represent an element of a group in the line
                                    $groupOutput[] = chr(rand($startAt, $endAt));
                                }
                            } else {
                                for ($i = 0; $i < $multiplier; $i++) { //each value represent an element of a group in the line
                                    if ($startIsInUC) {
                                        $charOne = chr(rand($startAt, $zUC));
                                    } else {
                                        $charOne = chr(rand($startAt, $zLC));
                                    }
                                    if ($endIsInUC) {
                                        $charTwo = chr(rand($aUC, $endAt));
                                    } else {
                                        $charTwo = chr(rand($aLC, $endAt));
                                    }
                                    $groupOutput[] = (rand(1, 50) >= 25) ? $charOne : $charTwo;
                                }
                            }
                        }

                        $groupOutput = implode('', $groupOutput);
                        if (strlen($groupOutput) != 0) {
                            $lineOutput[] = $groupOutput;
                        }
                    }
                    $lineOutput = implode(' ', $lineOutput);
                    if (strlen($lineOutput) != 0) {
                        $output[] = $lineOutput;
                    }
                }
            } else {
                $output[] = 'error on line ' . ($lineNumber + 1) . ' : ' . $line;
                break;
            }
        }
        return implode('|', $output);
    }
    
    /**
     * Do everything needed on the input format to make it understandable for the generateInput function
     * @param string $inputFormat
     */
    public static function prepareInputFormat(&$inputFormat) {
        $inputFormat = htmlspecialchars($_POST['inputFormat']);
        $inputFormat = str_replace('&gt;', '>', $inputFormat);
        $inputFormat = explode(PHP_EOL, $inputFormat);
        $inputFormat = array_map('trim', $inputFormat);
        $inputFormat = array_filter($inputFormat, function($element) {
            return strlen($element) != 0 && !preg_match(regex::INPUT_GENERATION_COMMENT, $element);
        });
    }
}
