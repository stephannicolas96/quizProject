<?php

include_once path::getClassesPath() . 'database.php';

class testCase extends database {
    
    public $id;
    public $questionId;
    public $input;
    public $output;
    
    public function getAllTestCases() {
        $returnValue = -2;
        if (preg_match(regex::getPrefixRegex(), $this->prefix)) {
            $getTestCases = $this->db->prepare('SELECT `input`, `output` FROM `' . $this->prefix . 'testCase` WHERE `id_T7rDZC_question` = :questionId');
            $getTestCases->bindValue(':questionId', $this->id, PDO::PARAM_INT);
            
            if ($getTestCases->execute()) {
                $returnValue = $getTestCases->fetchAll();
            } else {
                $returnValue = -1;
            }
        }
        return $returnValue;
    }

}
