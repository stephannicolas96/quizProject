<?php

class compiler {

    /**
     * 
     * @param type $generatedInput
     * @param type $langage
     * @param type $userCode
     * @return type
     */
    public static function compile($generatedInput, $langage, $userCode) {

        $output = array();

        //Prepare input parameter
        $inputs = explode('|', $generatedInput);
        array_pop($inputs);
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
                $output = self::executeUsingGCC('cpp', 'g++', $userCode, $parameterFile);
                break;
            case 'c' :
                $output = self::executeUsingGCC('c', 'gcc', $userCode, $parameterFile);
                break;
            default:
                break;
        }

        fclose($parameterFile);

        return $output;
    }

    /**
     * Return current timestamp to create a unique filename.
     * @param string $extension
     * @return string
     */
    public static function getFileName($extension) {
        $date = new DateTime();
        return $date->getTimestamp() . '.' . $extension;
    }

    /**
     * 
     * @param type $langage
     * @param type $compiler
     */
    public static function executeUsingGCC($langage, $compiler, $userCode, $parameterFile) {
        $output = array();

        $tempFile = fopen('../temp/' . self::getFileName($langage), 'w');
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

}
