<?php
include_once '../classes/path.php';

$pageBackground = '';
$pageTitle = '';
$controllerToLoad = 'profile.php';
include path::getLayoutPath() . 'header.php';
?>
<div class = "big-container splitScreen">
    <?php if ($canModify) { ?>
        <div>
            <form id="uploadImage" action="" method="POST" enctype="multipart/form-data">
                <div class="errors"></div>
                <div>
                    <input id="userImage" class="hidden" type="file" name="userImage" accept="image/png" />
                    <label for="userImage"><img id="userImageDisplayed" class="userImg clickable" src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" /></label>
                </div>
                <input name="id" type="hidden" value="<?= $userInstance->id ?>"/>
                <input type="submit" name="deleteUserImage" value="<?= ERASE_USER_IMAGE ?>" />
            </form>
            <form id="profileForm" action="" method="POST">
                <div class="errors"></div>
                <div class="success">SUCCESSFUL MODIFICATION TODO TRADUCTION</div>
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
            <img class="userImg" src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" />
            <p><?= USERNAME ?></p>
            <p><?= $userInstance->username ?></p>
            <p><?= EMAIL ?></p>
            <p><?= $userInstance->email ?></p>
        </div>
    <?php } ?>
    <div>
        <?php
        foreach ($details as $data) {
            if ($data->battle != 0) {
                ?>
                <p><?= $data->type ?></p>
                <ul data-pie-id="<?= $data->type ?>">
                    <li data-value="<?= $data->lost ?>">Lost</li>
                    <li data-value="<?= $data->draw ?>">Draw</li>
                    <li data-value="<?= $data->won ?>">Won</li>
                </ul>
                <div id="<?= $data->type ?>"></div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>
