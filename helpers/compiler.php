<?php

class compiler {

//    /**
//     * create the file needed for the execution of the code
//     * @param string $langage
//     * @param string $filePath
//     * @return string 
//     */
//    public static function getFilePath($langage, $userCode, &$filePath) {
//        switch ($langage) {
//            case 'php':
//                $output = compiler::compileUserCode($userCode, $filePath, 'php');
//                break;
//            case 'cpp':
//                $output = compiler::compileUserCode($userCode, $filePath, 'cpp', 'g++');
//                break;
//            case 'c' :
//                $output = compiler::compileUserCode($userCode, $filePath, 'c', 'gcc');
//                break;
//            case 'csharp' :
//                $output = compiler::compileUserCode($userCode, $filePath, 'cs', 'mono');
//                break;
//            default:
//                break;
//        }
//        return $output;
//    }
//
//    /**
//     * create a temporary file with the generated input in it and then execute the user code with this temporary file
//     * this allow the user code to have access to the generated input inside the standard input
//     * @param string $generatedInput
//     * @param string $langage
//     * @param string $userCode
//     * @return string
//     */
//    public static function prepareInputAndExecute($generatedInput, $filePath) {
//
//        //Prepare input parameter
//        $inputs = explode('|', $generatedInput);
//        $parameterFile = tmpfile();
//        $parameter = '<?php ';
//        foreach ($inputs as $input) {
//            $parameter = $parameter . 'echo(\'' . $input . PHP_EOL . '\');';
//        }
//
//        //Execute the user code and then close the temp file to delete it
//        fwrite($parameterFile, $parameter);
//        $output = self::executeUserCode($parameterFile, $filePath);
//        fclose($parameterFile);
//
//        return $output;
//    }
//
//    /**
//     * Return a file with an uniq name
//     * @param string $extension
//     * @return string
//     */
//    public static function getFileName($extension) {
//        return uniqid() . '.' . $extension;
//    }
//
//    /**
//     * Execute the user code
//     * @param string $parameterFile
//     * @param string $filePath
//     */
//    public static function executeUserCode($parameterFile, $filePath) {
//        $output = shell_exec('php  ' . stream_get_meta_data($parameterFile)['uri'] . ' | ' . $filePath . ' 2>&1'); // Execution
//        return $output;
//    }
//
//    /**
//     * Compile the user code to allow execution later
//     * @param string $langageExtension
//     * @param string $compiler
//     * @param string $userCode
//     * @param string $filePath
//     * @return string
//     */
//    public static function compileUserCode($userCode, &$filePath, $langageExtension, $compiler = '') {
//        $tempFile = fopen('../temp/' . self::getFileName($langageExtension), 'w');
//        fwrite($tempFile, $userCode);
//        $filePath = stream_get_meta_data($tempFile)['uri'];
//        if ($compiler != '') {
//            $output = shell_exec($compiler . ' ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); //Compilation
//            fclose($tempFile);
//            if (file_exists($filePath)) { // Erase UserCode File
//                unlink($filePath);
//            }
//            $filePath .= '.exe';
//        } else {
//            fclose($tempFile);
//        }
//        return (isset($output)) ? $output : '';
//    }

    //2>&1 means that we redirect the standard error in the standard output
    //this way we can use them to display some errors to the user

    /**
     * execute the code when the langage doesn't need a compilation
     * compile and then execute the code when the langage needs a compilation
     * @param type $generatedInput
     * @param type $langage
     * @param type $userCode
     * @return type
     */
    public static function compile($generatedInput, $langage, $userCode) {

        $output = array();

        //Prepare input parameter
        $inputs = explode('|', $generatedInput);
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
                $output = self::executeUserCode('cpp', 'g++', $userCode, $parameterFile);
                break;
            case 'c' :
                $output = self::executeUserCode('c', 'gcc', $userCode, $parameterFile);
                break;
            case 'csharp' :
                $output = self::executeUserCode('cs', 'mono', $userCode, $parameterFile);
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
     * compile and execute the user code
     * @param type $langage
     * @param type $compiler
     */
    public static function executeUserCode($langage, $compiler, $userCode, $parameterFile) {
        $output = array();

        $tempFile = fopen('../temp/' . self::getFileName($langage), 'w');
        fwrite($tempFile, $userCode);
        $filePath = stream_get_meta_data($tempFile)['uri'];
        $output['compilationOutput'] = shell_exec($compiler . ' ' . $filePath . ' -O3 -o ' . $filePath . '.exe 2>&1'); //Compilation
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
