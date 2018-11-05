<?php

include_once path::getClassesPath() . 'database.php';

class testCase extends database {

    public $id = 0;
    public $id_question = 0;
    public $input = '';
    public $output = '';
    
    /**
     * get all test cases for the current question
     * @return array()
     */
    public function getAllTestCases() {
        $returnValue = array();
        $query = 'SELECT `input`, `output` '
                . 'FROM `' . config::PREFIX . 'testCase` '
                . 'WHERE `id_question` = :id_question';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
    /**
     * create a test case for the current question
     * @return boolean
     */
    public function createTestCase() {
        $query = 'INSERT INTO `' . config::PREFIX . 'testCase` (`id_question`, `input`, `output`) '
                . 'VALUES ( '
                . ':id_question, '
                . ':input, '
                . ':output '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);
        $stmt->bindValue(':input', $this->input, PDO::PARAM_STR);
        $stmt->bindValue(':output', $this->output, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
