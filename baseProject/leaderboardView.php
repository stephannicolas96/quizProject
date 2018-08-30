<?php
session_start();
include_once 'assets/classes/path.php';
include path::getControllers() . 'leaderboardController.php';
include path::getControllers() . 'langageController.php';

$medalLink = array('gold', 'silver', 'bronze');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/import/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
        <link rel="stylesheet" href="assets/css/leaderboard.css">
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="assets/js/import/popper.min.js"></script>
        <script src="assets/js/import/bootstrap.min.js"></script>
        <script src="assets/js/index.js"></script>
        <title>QUIZ</title>
    </head>
    <body>
        <?php include path::getLayout() . 'navbar.php'; ?>
        <div class="container-fluid w-75 mt-5 p-0">
            <div class="row m-0">
                <div class="col-12 p-2">
                    <?php foreach ($leaderboardTop as $key => $user) { ?>
                        <div class="row m-0 p-3 <?= ($key % 2 == 1) ? 'bg-color-1' : 'bg-color-2'; ?>">
                            <div class="col-3 col-xl-1 p-0">
                                <img class="medalSize" src="<?= path::getImages() . $medalLink[$key]; ?>.png" title="<?= $medalLink[$key] ?> medal" alt="<?= $medalLink[$key] ?> medal" />
                            </div>
                            <div class="col-3 col-xl-1 p-0" >
                                <img class="userImage d-flex align-items-center text-center" src="<?= (file_exists(path::getUserImages() . $user['id'] . '.png')) ? path::getUserImages() . $user['id'] . '.png' : path::getUserImages() . 'user-image.png' ?>" style="background-color: <?= '#' . $user['color'] ?>" title="user image" alt="user image" />
                            </div>
                            <div class="col-4 col-xl-3 d-flex align-items-center p-0">
                                <p class="font-italic"><?= $user['username'] ?></p>
                            </div>
                            <div class="col-2 offset-xl-5 col-md-2 d-flex align-items-center p-0">
                                <p class="font-weight-bold text-center w-100"><?= $user['score'] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($_SESSION['logged']) && $_SESSION['logged']) { ?>
                <hr class="m-0" />
                <div class="row m-0">
                    <div class="col-12 p-4">
                        <?php foreach ($leaderboardAroundUser as $key => $user) { ?>
                            <div class="row m-0 px-3 py-3 <?= ($key % 2 == 1) ? 'bg-color-1' : 'bg-color-2' ?>">
                                <div class="col-3 col-xl-1 d-flex align-items-center p-0">
                                    <p class="font-weight-bold"><?= $user['id'] + $index ?>.</p>
                                </div>
                                <div class="col-3 col-xl-1 p-0" >
                                    <img class="userImage d-flex align-items-center text-center" src="<?= (file_exists(path::getUserImages() . $user['id'] . '.png')) ? path::getUserImages() . $user['id'] . '.png' : path::getUserImages() . 'user-image.png' ?>" style="background-color: <?= '#' . $user['color'] ?>" title="user image" alt="user image" />
                                </div>
                                <div class="col-4 col-xl-3 d-flex align-items-center p-0">
                                    <p class="font-italic"><?= $user['username'] ?></p>
                                </div>
                                <div class="col-2 offset-xl-5 col-md-2 d-flex align-items-center p-0">
                                    <p class="font-weight-bold text-center w-100"><?= $user['score'] ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </body>
</html>