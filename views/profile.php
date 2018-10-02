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
            <form action="#" method="POST">
                <div>
                    <input id="newUserImage" type="file" name="newUserImage"/>
                    <label for="newUserImage"><img src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" /></label>
                </div>
                <?php foreach ($profileInputs as $inputData) { ?>
                    <div class="<?= $inputData->wrappingDivClasses ?>">
                        <input <?= $inputData->inputAttr ?> />
                        <label for="<?= $inputData->labelAttr ?>"><?= $inputData->labelContent ?></label>
                    </div>
                <?php } ?>
                <input type="button" value="<?= CHANGE_PASSWORD ?>" />
                <input type="button" id="deleteUser" value="<?= ERASE_ACCOUNT ?>" />
                <input type="submit" name="update" value="<?= SAVE ?>" />
                <input type="submit" name="deleteUserImage" value="<?= ERASE_USER_IMAGE ?>" />
            </form>
        </div>
    <?php } else { ?>
        <div>
            <img src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" />

            <h2><?= USERNAME ?></h2>
            <p><?= $userInstance->username ?></p>
            <h2><?= EMAIL ?></h2>
            <p><?= $userInstance->email ?></p>
        </div>
    <?php } ?>
    <div>
        <?php foreach ($details as $data) { ?>
        <p>langage: <?= $data->type ?>/battle: <?= is_null($data->battle) ? 0 : $data->battle ?>/won: <?= is_null($data->won) ? 0 : $data->won ?>/draw: <?= is_null($data->draw) ? 0 : $data->draw ?>/lost: <?= is_null($data->lost) ? 0 : $data->lost ?></p>
        <?php } ?>
    </div>
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>
