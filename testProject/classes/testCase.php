<?php

include_once path::getClassesPath() . 'database.php';

class testCase extends database {

    public $testCases = 1;
    
    public function getAllTestCases($questionId) {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $getTestCases = $this->db->prepare('SELECT `input`, `output` FROM `' . $this->prefix . 'testCase` WHERE `id_T7rDZC_question` = :questionId');
            $getTestCases->bindValue(':questionId', $questionId, PDO::PARAM_INT);
            
            if ($getTestCases->execute()) {
                $this->testCases = $getTestCases->fetchAll();
                $returnValue = 1;
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

}
