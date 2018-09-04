<?php

$langage = 'cpp';
$userCode = '#include <iostream> ' . PHP_EOL .
            '#include <limits> ' . PHP_EOL .
            '#include <sstream> ' . PHP_EOL .
            'int main() {' . PHP_EOL .
            'std::string line;' . PHP_EOL .
            'while (std::getline(std::cin, line))' . PHP_EOL .
            '{' . PHP_EOL .
            'std::cout << line;' . PHP_EOL .
            '}' . PHP_EOL .
            '}';
//PHP COMPILER
$parameterFile = tmpfile();
$output = null;
$parameter = '<?php echo  \'1200 489489 489 9989 97676 884849\'' . PHP_EOL . ' ?>';
fwrite($parameterFile, $parameter);
switch ($langage) {
    case 'php':
        $tempFile = tmpfile();
        $code = '<?php ' . $userCode;
        fwrite($tempFile, $code);
        $output = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | php ' . stream_get_meta_data($tempFile)['uri']);
        fclose($tempFile);
        break;
    case 'cpp':
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $cppFile = fopen('../cpp/' . $timestamp . '.cpp', 'w');
        $code = $userCode;
        fwrite($cppFile, $code);
        $filePath = stream_get_meta_data($cppFile)['uri'];
        shell_exec('g++ ' . $filePath . ' -O3 -o ' . $filePath . '.exe');
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
echo $output;
fclose($parameterFile);
