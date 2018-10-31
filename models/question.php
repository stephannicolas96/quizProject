<?php

include_once path::getClassesPath() . 'database.php';

class question extends database {

    public $id = 0;
    public $enunciated = '';
    public $input = '';
    public $output = '';
    public $difficulty = '';
    public $id_user = 0;
    
    /**
     * insert a question in the database
     * @return bool
     */
    public function createQuestion() {
        $query = 'INSERT INTO `' . config::PREFIX . 'question` (`enunciated`, `input`, `output`, `difficulty`, `id_user`) '
                . 'VALUES ( '
                . ':enunciated, '
                . ':input, '
                . ':output, '
                . ':difficulty, '
                . ':id_user '
                . ')';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':enunciated', $this->enunciated, PDO::PARAM_STR);
        $stmt->bindValue(':input', $this->input, PDO::PARAM_STR);
        $stmt->bindValue(':output', $this->output, PDO::PARAM_STR);
        $stmt->bindValue(':difficulty', $this->difficulty, PDO::PARAM_INT);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

        return $stmt->execute();
    }
    
     /**
     * get a random question id which wasn't created by one of the two players
     * @return int
     */
    public function getRandomQuestionNotCreatedByThePlayers($playerOneId, $playerTwoId) {
        $returnValue = -1;
        $query = 'SELECT `q`.`id`' .
                'FROM `T7rDZC_question` AS `q` ' .
                'JOIN (SELECT ' .
                'ROUND(RAND() * (SELECT ' .
                'MAX(`id`) ' .
                'FROM `T7rDZC_question` ' .
                ')) AS `id` ' .
                ') AS `x`' .
                'WHERE `q`.`id` >= `x`.`id` AND `q`.`id_user` != :playerOneId AND `q`.`id_user` != :playerTwoId ' .
                'LIMIT 1';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':playerOneId', $playerOneId, PDO::PARAM_INT);
        $stmt->bindValue(':playerTwoId', $playerTwoId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $returnValue = $stmt->fetch(pdo::FETCH_COLUMN);
        }
        
        if(!$returnValue){
            $returnValue = self::getRandomQuestion();
        }
        
        return $returnValue;
    }
    
    /**
     * get a random question id
     * @return int
     */
    public static function getRandomQuestion() {
        $returnValue = -1;
        $query = 'SELECT `q`.`id`' .
                'FROM `T7rDZC_question` AS `q` ' .
                'JOIN (SELECT ' .
                'ROUND(RAND() * (SELECT ' .
                'MAX(`id`) ' .
                'FROM `T7rDZC_question` ' .
                ')) AS `id` ' .
                ') AS `x`' .
                'WHERE `q`.`id` >= `x`.`id`' .
                'LIMIT 1';

        if ($result = database::getInstance()->query($query)) {
            $returnValue = $result->fetch(pdo::FETCH_COLUMN);
        }
        return $returnValue;
    }
    
    /**
     * Get question data
     * @return bool
     */
    public function getQuestion(){
        $returnValue = false;
        $query = 'SELECT `enunciated`, `input`, `output` '
                . 'FROM `' . config::PREFIX . 'question` '
                . 'WHERE `id` = :id';

        $stmt = database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if(is_object($data)){
                $this->enunciated = $data->enunciated;
                $this->input = $data->input;
                $this->output = $data->output;
                $returnValue = true;
            }
        }
        return $returnValue;
    }

}
