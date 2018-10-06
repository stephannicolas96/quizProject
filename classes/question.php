<?php

include_once path::getClassesPath() . 'database.php';

class question extends database {

    public $id;
    public $enunciated;
    public $input;
    public $output;
    public $difficulty;
    
    /**
     * 
     * @return boolean
     */
    public function createQuestion() {
        $returnValue = false;
        $query = 'INSERT INTO `' . database::PREFIX . 'question` (`enunciated`, `input`, `output`, `difficulty`) '
                . 'VALUES ( '
                . ':enunciated, '
                . ':input, '
                . ':output, '
                . ':difficulty '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':enunciated', $this->enunciated, PDO::PARAM_STR);
        $stmt->bindValue(':input', $this->input, PDO::PARAM_STR);
        $stmt->bindValue(':output', $this->output, PDO::PARAM_STR);
        $stmt->bindValue(':difficulty', $this->difficulty, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = true;
        }
        return $returnValue;
    }

    /**
     * 
     * @return type
     */
    public function getLastQuestionId() {
        $returnValue = null;
        $query = 'SELECT MAX(`id`) AS `id`'
                . 'FROM `' . database::PREFIX . 'question`';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetch(PDO::FETCH_OBJ);
        }
        return $returnValue;
    }

}
