<?php

include_once path::getClassesPath() . 'database.php';

class testCase extends database {

    public $id;
    public $questionId;
    public $input;
    public $output;

    public function getAllTestCases() {
        $returnValue = null;
        $query = 'SELECT `input`, `output` '
                . 'FROM `' . database::PREFIX . 'testCase` '
                . 'WHERE `id_T7rDZC_question` = :questionId';

        $getTestCases = database::getInstance()->prepare();
        $getTestCases->bindValue(':questionId', $this->id, PDO::PARAM_INT);

        if ($getTestCases->execute()) {
            $returnValue = $getTestCases->fetchAll();
        }
        
        return $returnValue;
    }

}
