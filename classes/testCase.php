<?php

include_once path::getClassesPath() . 'database.php';

class testCase extends database {

    public $id;
    public $id_question;
    public $input;
    public $output;
    
    /**
     * 
     * @return type
     */
    public function getAllTestCases() {
        $returnValue = null;
        $query = 'SELECT `input`, `output` '
                . 'FROM `' . database::PREFIX . 'testCase` '
                . 'WHERE `id_question` = :id_question';

        $stmt = database::getInstance()->prepare();
        $stmt->bindValue(':id_question', $this->id_question, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetchAll(PDO::FETCH_OBJ);
        }
        
        return $returnValue;
    }
    
    /**
     * 
     * @return boolean
     */
    public function createTestCase() {
        $query = 'INSERT INTO `' . database::PREFIX . 'testCase` (`id_question`, `input`, `output`) '
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
