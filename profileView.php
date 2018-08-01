<?php
session_start();
include_once 'assets/classes/path.php';
include path::$controllers . 'profileController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
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
        include path::$layout . 'navbar.php';
        ?>
        <img class="userImage d-flex align-items-center text-center" src="<?= (file_exists(path::$userImages . $profileUserInstance->id . '.png')) ? path::$userImages . $profileUserInstance->id . '.png' : path::$userImages . 'user-image.png' ?>" style="background-color: <?= '#' . $profileUserInstance->color ?>" title="user image" alt="user image" />
        <p><?= $profileUserInstance->username ?></p>
        <p><?= $profileUserInstance->mail ?></p>
    </body>
</html>