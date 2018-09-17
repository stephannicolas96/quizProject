<?php
session_start();
include_once 'classes/path.php';
include_once path::getControllersPath() . 'indexController.php';
include_once path::getControllersPath() . 'langageController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>BATTLELY</title>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>        
        <?php include path::getLayoutPath() . 'navbar.php'; ?>

        <script src="assets/js/import/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="assets/js/valueChecker.js"></script>
        <script src="assets/js/materializeInitializer.js"></script>
        <script src="assets/js/registration.js"></script>
    </body> 
</html>

