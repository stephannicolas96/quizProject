<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'leaderboard.php';

$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';
?>
<div class="container-fluid w-75 mt-5 p-0">
    <div class="row m-0">
        <div class="col-12 p-2">
            <?php foreach ($leaderboardTop as $key => $user) { ?>
                <div class="">
                        <img src="" title="medal" alt="medal" />
                        <img src="..assets/images/userImages/<?= helpers::getUserImageName($user->id) ?>" style="background-color: <?= '#' . $user['color'] ?>" title="user image" alt="user image" />
                        <p><?= $user->username ?></p>
                        <p><?= $user->score ?></p>
                </div>
            <?php } ?>
        </div>
    </div>