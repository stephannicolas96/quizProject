<?php

include_once '../classes/path.php';
include_once path::getClassesPath() . 'duel.php';

$duelInstance = new duel;

$duelInstance->deleteExpiredDuel();