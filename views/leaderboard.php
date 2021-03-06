<?php
include_once '../classes/path.php';

$pageTitle = 'LEADERBOARD';
$controllerToLoad = 'leaderboard.php';
include path::getLayoutPath() . 'header.php';
include path::getLayoutPath() . 'modeSelector.php';
?>
<div class="big-container">
    <?php foreach ($leaderboardTop as $user) { ?>
        <a class="score-row leader <?= $colors[$user->rank - 1] ?>" href="profile-<?= $user->id ?>">
            <img class="userImg" src="../assets/images/userImages/<?= $user->image ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </a>
    <?php } ?>
</div>
<div class="md-container">
    <?php foreach ($leaderboardTwentyPlayers as $row => $user) { ?>
        <a class="score-row <?= $row % 2 ? 'light' : 'normal' ?>" href="profile-<?= $user->id ?>">
            <p><?= $user->rank ?></p>
            <img class="userImg" src="../assets/images/userImages/<?= $user->image ?>" style="background-color: <?= '#' . $user->color ?>" title="user image" alt="user image" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
            <p><?= $user->username ?></p>
            <p><?= $user->points ?></p>
        </a>
    <?php } ?>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>