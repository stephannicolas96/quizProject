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
        <a class="score-row" href="profile-<?= $user->id ?>.html">
            <img src="" title="medal" alt="medal" />
            <img class="userImg" src="../assets/images/userImages/<?= $user->image ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </a>
    <?php } ?>
</div>
<div class="md-container">
    <?php foreach ($leaderboardTwentyPlayers as $user) { ?>
        <a class="score-row" href="profile-<?= $user->id ?>.html">
            <p><?= $user->rank ?></p>
            <img class="userImg" src="../assets/images/userImages/<?= $user->image ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </a>
    <?php } ?>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>