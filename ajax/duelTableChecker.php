<?php

include_once '../classes/path.php';
include_once path::getModelsPath() . 'duel.php';

$duelInstance = new duel;

$duelInstance->deleteExpiredDuel();