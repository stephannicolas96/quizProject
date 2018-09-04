<?php

$langage = 'cpp'; // ADD POST VARIABLE
$userCode = $_POST['code']; // SECURE THIS
//PHP COMPILER
$parameterFile = tmpfile();
$parameter = '<?php echo  \'1200 489489 489 9989 97676 884849\'' . PHP_EOL . '  ?>';
fwrite($parameterFile, $parameter);
$output = null;
switch ($langage) {
    case 'php':
        $tempFile = tmpfile();
        $code = '<?php ' . $userCode;
        fwrite($tempFile, $code);
        $output = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | php ' . stream_get_meta_data($tempFile)['uri']);
        fclose($tempFile);
        break;
    case 'cpp':

        $cppFile = fopen('../../temp/' . getFileName('cpp'), 'w');
        fwrite($cppFile, $userCode);
        $filePath = stream_get_meta_data($cppFile)['uri'];
        $output = shell_exec('g++ ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); //2 standard error 1 standard output >& redirection
        $output = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | ' . $filePath . '.exe');
        fclose($cppFile);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        if (file_exists($filePath . '.exe')) {
            unlink($filePath . '.exe');
        }
        break;
    default:
        break;
}

var_dump($output); //TEMP REMOVE

fclose($parameterFile);

/**
 * Return current timestamp to create a unique filename.
 * @param string $extension
 * @return string
 */
function getFileName($extension) {
    $date = new DateTime();
    return $date->getTimestamp() . '.' . $extension;  
}
