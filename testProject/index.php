<?php
session_start();
include_once 'assets/classes/path.php';
include path::getLangagePath() . 'fr_FR.php'; //TEMP REMOVE
include_once path::getControllersPath() . 'indexController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>
    </body>
</html>

