<?php
include_once '../classes/path.php';

$pageTitle = 'PROFILE';
$controllerToLoad = 'profile.php';
include path::getLayoutPath() . 'header.php';
?>
<div class = "big-container split middleBorder">
    <?php if ($canModify) { ?>
        <div>
            <form id="uploadImage" action="" method="POST" enctype="multipart/form-data">
                <div class="errors hidden"></div>
                <div class="relative">
                    <input id="userImage" class="hidden" type="file" name="userImage" accept="image/png" />
                    <label for="userImage" class="center">
                        <img id="userImageDisplayed" class="userImg clickable" src="../assets/images/userImages/<?= $userInstance->image ?>" title="user image" alt="user image" style="background-color: <?= '#' . $userInstance->color ?>" onerror="this.src='../assets/images/userImages/user-image.png'"  onabort="this.src='../assets/images/userImages/user-image.png'" />
                        <button type="submit" name="deleteUserImage" value="X"><img src="../assets/images/close.png" /></button>
                    </label>
                </div>
                <input name="id" type="hidden" value="<?= $userInstance->id ?>"/>
            </form>
            <form id="profileForm" action="" method="POST">
                <div class="errors hidden"></div>
                <div class="success hidden"><?= SUCCESSFUL_MODIFICATION ?></div>
                <div class="loader medium"></div>
                <?php foreach ($profileInputs as $inputData) { ?>
                    <div class="<?= $inputData->wrappingDivClasses ?>">
                        <input <?= $inputData->inputAttr ?> />
                        <label for="<?= $inputData->labelAttr ?>"><?= $inputData->labelContent ?></label>
                    </div>
                <?php } ?>
                <input type="submit" name="deleteUser" value="<?= ERASE_ACCOUNT ?>" />
                <input type="submit" name="update" value="<?= SAVE ?>" />
            </form>
        </div>
    <?php } else { ?>
        <div>
            <img class="userImg center" src="../assets/images/userImages/<?= $userInstance->image ?>" title="user image" alt="user image" style="background-color: <?= '#' . $userInstance->color ?>" onerror="this.src='../assets/images/userImages/user-image.png'"  onabort="this.src='../assets/images/userImages/user-image.png'" />
            <p><?= USERNAME ?></p>
            <p><?= $userInstance->username ?></p>
        </div>
    <?php } ?>
    <div class="split">
        <?php
        foreach ($userDuelDataTransformed as $langage => $states) {
            if (count($states) > 0) {
                ?>
                <div>
                    <ul data-pie-id="<?= $langage ?>" class="hidden">
                        <?php foreach ($states as $stateName => $amount) { ?>
                            <li data-value="<?= $amount ?>" class="<?= $stateName ?>"><?= $stateName ?></li>
                        <?php } ?>
                    </ul>
                    <div id="<?= $langage ?>" class="v-center pie-chart"></div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>