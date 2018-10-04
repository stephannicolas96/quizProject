<?php

/**
 * 
 * @param type $testCases
 * @param type $langage
 * @param type $userCode
 */
function compile($testCases, $langage, $userCode) {

    $output = array();

    //Prepare input parameter
    $inputs = explode('|', $testCase['input']);
    $parameterFile = tmpfile();
    $parameter = '<?php ';
    foreach ($inputs as $input) {
        $parameter = $parameter . 'echo(\'' . $input . PHP_EOL . '\');';
    }
    
    fwrite($parameterFile, $parameter);

    switch ($langage) {
        case 'php':
            $tempFile = tmpfile();
            fwrite($tempFile, $userCode);
            $output['executionOutput'] = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | php ' . stream_get_meta_data($tempFile)['uri'] . ' 2>&1');
            fclose($tempFile);
            break;
        case 'cpp':
            $output = executeUsingGCC('cpp', 'g++', $userCode);
            break;
        case 'c' :
            $output = executeUsingGCC('c', 'gcc', $userCode);
            break;
        default:
            break;
    }

    fclose($parameterFile);
}

/**
 * Return current timestamp to create a unique filename.
 * @param string $extension
 * @return string
 */
function getFileName($extension) {
    $date = new DateTime();
    return $date->getTimestamp() . '.' . $extension;
}

/**
 * 
 * @param type $langage
 * @param type $compiler
 */
function executeUsingGCC($langage, $compiler, $userCode) {
    $output = array();

    $tempFile = fopen('../temp/' . getFileName($langage), 'w');
    fwrite($tempFile, $userCode);
    $filePath = stream_get_meta_data($tempFile)['uri'];
    $output['compilationOutput'] = shell_exec($compiler . ' ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); //Compilation & 2 standard error 1 standard output >& redirection
    $output['executionOutput'] = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | ' . $filePath . '.exe 2>&1'); // Execution
    fclose($tempFile);

    if (file_exists($filePath)) { // Erase .c file
        unlink($filePath);
    }
    if (file_exists($filePath . '.exe')) { // Erase .exe file
        unlink($filePath . '.exe');
    }

    return $output;
}
