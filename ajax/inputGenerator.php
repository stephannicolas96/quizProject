<?php

/**
 * Transform each row of the input into a real input following some rules:
 * (int)->(int); => random in the range of the two numbers
 * (int)->(int)x(int); => random in the range of the two number repeated x times
 * @param string $array
 * @return string
 */
/*
  function generateInput($array) {
  $randomBetweenTwoNumber = '/^[\d]+->[\d]+$/';
  $randomBetweenTwoNumberSplitRegex = '/(->)/';
  $randomBetweenTwoNumberMultipleTimes = '/^[\d]+->[\d]+[xX\*][\d]+$/';
  $randomBetweenTwoNumberMultipleTimesSplitRegex = '/(->|[xX\*])/';

  $output = null;
  foreach ($array as $lineNumber => $line) {
  $groupOutput = null;
  if (preg_match($randomBetweenTwoNumber, $line)) {
  $values = preg_split($randomBetweenTwoNumberSplitRegex, $line);
  $groupOutput = rand($values[0], $values[1]);
  } else if (preg_match($randomBetweenTwoNumberMultipleTimes, $line)) {
  $values = preg_split($randomBetweenTwoNumberMultipleTimesSplitRegex, $line);
  for ($i = 0; $i < $values[2]; $i++) {
  $groupOutput = $groupOutput . ' ' . rand($values[0], $values[1]);
  }
  } else {
  $output = 'error on line ' . ($lineNumber + 1) . ' : ' . $line;
  break;
  }
  $output = $output . trim($groupOutput) . '|';
  }
  return $output;
  }
 */

/**
 * Transform each line of the input into a real input following some rules:
 * (int)->(int); => random in the range of the two numbers
 * (int)->(int)x(int); => random in the range of the two number repeated x times
 * @param string $array
 * @return string
 */
function generateInput($array) {
    $regexForLine = '/^((([A-z]->[A-z]|[\d]+->[\d]+)([\*][\d]+){0,1})\/{0,1})+(?<=[A-z]|[\d])$/';
    $regexSplitLineByGroup = '/\//';
    $regexSplitGroup = '/->|\*/';

    $output = array();
    foreach ($array as $lineNumber => $line) {
        $lineOutput = array();
        if (preg_match($regexForLine, $line)) { //$line is a line inside the input editor
            $groups = preg_split($regexSplitLineByGroup, $line);
            foreach ($groups as $group) { //$groups are separated by '/' inside the input editor
                $groupOutput = array();
                $data = preg_split($regexSplitGroup, $group);
                switch (count($data)) {
                    case 2:
                    case 3:
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
                        break;
                    case 4:
                        break;
                    default:
                        break;
                }
                $groupOutput = implode('', $groupOutput);
                if (strlen($groupOutput) != 0) {
                    $lineOutput[] = $groupOutput;
                }
            }
        } else {
            $output[] = 'error on line ' . ($lineNumber + 1) . ' : ' . $line;
            break;
        }
        $lineOutput = implode(' ', $lineOutput);
        if (strlen($lineOutput) != 0) {
            $output[] = $lineOutput;
        }
    }
    return implode('|', $output);
}

// ASCII
// INT TO CHAR chr();
// CHAR TO INT ord();
// RANDOM LETTER MAJ 65->90 
// RANDOM LETTER MIN 97->122