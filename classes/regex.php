<?php

/**
 * class that hold all the regex needed in the project
 */
class regex {

    const USERNAME = '/^[A-Za-z][A-Za-z0-9]*(?:[_-][A-Za-z0-9]+)*$/';
    //Minimum 8 characters
    const BAD_PASSWORD = '/(?=.{8,}).*/';
    //Alpha Numeric plus minimum 8
    const GOOD_PASSWORD = '/^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
    const BETTER_PASSWORD = '/^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/';
    //Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
    const BEST_PASSWORD = '/^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/';
    //Check if the question contains all the needed terms
    const QUESTION_CONTAINS = '/(Énoncé|Enunciated)\b.*?\b(Entrée|Input)\b.*?\b(Sortie|Output)/ms';
    //Split the question where it's needed to store it in the database
    const QUESTION_SPLIT = '/(Énoncé|Enunciated|Entrée|Input|Sortie|Output)/ms';
    //Check the content of each line in the input
    const INPUT_GENERATION_LINE = '/^((([A-z]->[A-z]|-?[\d]+->-?[\d]+)([\*][\d]+){0,1})\/{0,1})+(~[\d]+->[\d]+){0,1}(?<=[A-z]|[\d])$/';
    //Split each pattern in the line
    const INPUT_GENERATION_PATTERN_SPLIT = '/\//';
    //Split the repeat part of the line
    const INPUT_GENERATION_REPEAT_LINE_SPLIT = '/~/';
    //Split each part of each pattern to allow the manipulation
    const INPUT_GENERATION_PATTERN_PART_SPLIT = '/->|\*/';
    //Check if the input generation have generated any error
    const INPUT_GENERATION_ERROR = '/error.+/';
    //Check if the input generation contain any comment
    const INPUT_GENERATION_COMMENT = '/^\#.*$/';
    //Check if the output generation have generated any error
    const OUTPUT_GENERATION_ERROR = '/.+(\/temp|tmp).+/';

}
