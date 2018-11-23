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
                    <input id="userImage" class="hidden" type="file" name="userImage" accept="image/png,image/jpeg" />
                    <label for="userImage" class="center">
                        <img id="userImageDisplayed" class="userImg clickable" src="../assets/images/userImages/<?= $userInstance->image ?>" title="user image" alt="user image" style="background-color: <?= '#' . $userInstance->color ?>" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
                        <button type="submit" name="deleteUserImage" value="X"><img src="../assets/images/close" /></button>
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
                <div class="split">
                    <input type="submit" class="btn-flat" name="deleteUser" value="<?= ERASE_ACCOUNT ?>" />
                    <input type="submit" class="btn-flat" name="update" value="<?= SAVE ?>" />
                </div>
            </form>
        </div>
    <?php } else { ?>
        <div>
            <img class="userImg center" src="../assets/images/userImages/<?= $userInstance->image ?>" title="user image" alt="user image" style="background-color: <?= '#' . $userInstance->color ?>" onerror="this.src='../assets/images/userImages/user-image'"  onabort="this.src='../assets/images/userImages/user-image'" />
            <p><?= USERNAME ?></p>
            <p><?= $userInstance->username ?></p>
        </div>
    <?php } ?>
    <div class="split">
        <ul class="span-2">
            <li>
                <?= DRAW ?>
                <div></div>
            </li>
            <li>
                <?= EXPIRED ?>
                <div></div>
            </li>
            <li>
                <?= LOST ?>
                <div></div>
            </li>
            <li>
                <?= WON ?>
                <div></div>
            </li>
        </ul>
        <?php
        foreach ($userDuelDataTransformed as $langage => $states) {
            if (count($states) > 0) {
                ?>
                <div>
                    <ul data-pie-id="<?= $langage ?>" class="hidden">
                        <?php foreach ($states as $stateName => $amount) { ?>
                            <li data-value="<?= $amount ?>" data-text-color="red" class="<?= $stateName ?>"><?= $stateName ?></li>
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