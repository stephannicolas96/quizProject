<?php

$mode = $_POST['mode'];// SECURE THIS
$userInput = $_POST['code'];// SECURE THIS 
$testCases = $_POST['inputs'];// SECURE THIS
$outputs = array();

foreach ($testCases as $testCase) {
//PHP COMPILER
    $compilationOutput = null;
    $executionOutput= null;
    
    //Prepare input parameter
    $inputs = explode('|', $testCase);
    $parameterFile = tmpfile();
    $parameter = '<?php ';
    foreach ($inputs as $input) {
        $parameter = $parameter . 'echo(\'' . $input . PHP_EOL . '\');';
    }
    fwrite($parameterFile, $parameter);
    
    switch ($mode) {
        case 'php':
            $tempFile = tmpfile();
            fwrite($tempFile, $userInput);
            $executionOutput = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | php ' . stream_get_meta_data($tempFile)['uri'] . ' 2>&1');
            fclose($tempFile);
            break;
        case 'cpp':
            $tempFile = fopen('../temp/' . getFileName('cpp'), 'w');
            fwrite($tempFile, $userInput);
            $filePath = stream_get_meta_data($tempFile)['uri'];
            $compilationOutput = shell_exec('g++ ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); // Compilation & 2 standard error 1 standard output >& redirection
            $executionOutput = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | ' . $filePath . '.exe 2>&1'); // Execution
            fclose($tempFile);
            
            if (file_exists($filePath)) { // Erase .cpp file
                unlink($filePath);
            }
            if (file_exists($filePath . '.exe')) { // Erase .exe file
                unlink($filePath . '.exe');
            }
            break;
        case 'c' :
            $tempFile = fopen('../temp/' . getFileName('c'), 'w');
            fwrite($tempFile, $userInput);
            $filePath = stream_get_meta_data($tempFile)['uri'];
            $compilationOutput = shell_exec('gcc ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); //Compilation & 2 standard error 1 standard output >& redirection
            $executionOutput = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | ' . $filePath . '.exe 2>&1'); // Execution
            fclose($tempFile);
            
            if (file_exists($filePath)) { // Erase .c file
                unlink($filePath);
            }
            if (file_exists($filePath . '.exe')) { // Erase .exe file
                unlink($filePath . '.exe');
            }
            break;
        default:
            break;
    }
    
    $outputs[] = $executionOutput;

    fclose($parameterFile);
}
print_r($outputs);

/**
 * Return current timestamp to create a unique filename.
 * @param string $extension
 * @return string
 */
function getFileName($extension) {
    $date = new DateTime();
    return $date->getTimestamp() . '.' . $extension;
}