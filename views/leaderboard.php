<?php
include_once '../classes/path.php';

$pageBackground = '';
$pageTitle = '';
$controllerToLoad = 'leaderboard.php';
include path::getLayoutPath() . 'header.php';
include path::getLayoutPath() . 'modeSelector.php'
?>
<div class="big-container">
    <?php foreach ($leaderboardTop as $user) { ?>
        <div class="score-row">
            <img src="" title="medal" alt="medal" />
            <img src="../assets/images/userImages/<?= helpers::getUserImageName($user->id) ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </div>
    <?php } ?>
</div>
<div class="md-container">
    <?php foreach ($leaderboardAroungPlayer as $user) { ?>
        <div class="score-row">
            <p><?= $user->rank ?></p>
            <img src="../assets/images/userImages/<?= helpers::getUserImageName($user->id) ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </div>
    <?php } ?>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>