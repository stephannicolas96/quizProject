<?php
session_start();
include_once 'assets/classes/path.php';
include path::getControllers() . 'langageController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/import/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/temp.css">
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="assets/js/import/popper.min.js"></script>
        <script src="assets/js/import/bootstrap.min.js"></script>
        <script src="assets/js/index.js"></script>
        <title>QUIZ</title>
    </head>
    <body>
        <div id="pageTop">

        </div>                  
        <?php
        include path::getLayout() . 'navbar.php';
        ?>
        
    </body>
</html>