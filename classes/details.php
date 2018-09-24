<?php

include_once path::getClassesPath() . 'database.php';

class details extends database {

    public $id;
    public $numberOfBattle;
    public $numberOfBattleWon;
    public $numberOfBattleDraw;
    public $userId;
    public $languageType;

}
