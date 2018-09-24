<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'profile.php';

$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';

if ($canModify) {
    ?>
    <!-- MODIFICATION DU PROFILE -->
    <form action="#" method="POST">
        <div>
            <label for="newUserImage"><img src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" /></label>
            <input id="newUserImage" type="file" name="newUserImage"/>
        </div>
        <div class="input-field">
            <input type="text" name="username"  value="<?= $userInstance->username ?>" required />
            <label><?= defined('USERNAME') ? USERNAME : 'Username' ?></label>
        </div>
        <div class="input-field">
            <input type="text" name="mail" value="<?= $userInstance->email ?>" required />
            <label><?= defined('EMAIL') ? EMAIL : 'Email address' ?></label>
        </div>
        <div class="input-field">
            <input type="password" name="actualPassword" required />
            <label><?= defined('PASSWORD') ? PASSWORD : 'Password' ?></label>
        </div>
        <div class="input-field">
            <input type="password" name="newPassword" />
            <label><?= defined('NEW_PASSWORD') ? NEW_PASSWORD : 'New password' ?></label>
        </div>

        <input type="button" value="<?= defined('CHANGE_PASSWORD') ? CHANGE_PASSWORD : 'Change password' ?>" />
        <input type="button" id="deleteUser" value="<?= defined('ERASE_ACCOUNT') ? ERASE_ACCOUNT : 'Erase account' ?>" />
        <input type="submit" name="update" value="<?= defined('SAVE') ? SAVE : 'Save' ?>" />
    </form>
    <form action="#" method="POST">
        <input type="submit" name="stopUpdate" value ="<?= defined('CANCEL') ? CANCEL : 'Cancel' ?>" />
    </form>
    <form action="#" method="POST">
        <input type="submit" name="deleteUserImage" value="<?= defined('ERASE_USER_IMAGE') ? ERASE_USER_IMAGE : 'Erase image' ?>" />
    </form>
<?php } else { ?>
    <!-- VISUALISATION DU PROFILE -->

    <img src="../assets/images/userImages/<?= $userImage ?>" title="user image" alt="user image" />

    <h2><?= defined('USERNAME') ? USERNAME : 'Username' ?></h2>
    <p><?= $userInstance->username ?></p>
    <h2><?= defined('EMAIL') ? EMAIL : 'Email address' ?></h2>
    <p><?= $userInstance->email ?></p>
    <?php
}

include path::getLayoutPath() . 'footer.php';
?>
