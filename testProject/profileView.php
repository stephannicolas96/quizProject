<?php
session_start();
include_once 'classes/path.php';
include_once path::getControllersPath() . 'profileController.php';
include_once path::getControllersPath() . 'langageController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    </head>
    <body>            
        <?php include path::getLayoutPath() . 'navbar.php'; ?>
        <?php if ($canModify && $modifying) { ?>
            <!-- MODIFICATION DU PROFILE -->
            <form action="#" method="POST">
                <label for="newUserImage">      
                    <img src="<?= ($userImageExist) ? $savedUserImagePath : path::getUserImagesPath() . 'user-image.png' ?>" title="user image" alt="user image" />
                </label>
                <?php if ($userImageExist) { ?>
                    <input id="newUserImage" type="file" name="newUserImage"/>
                <?php } ?>

                <label>
                    <?= defined('username') ? username : 'Username' ?>
                    <input type="text" name="username"  value="<?= ($savedUsername) ? $savedUsername : '' ?>" required />
                </label>
                <label>
                    <?= defined('mail') ? mail : 'Mail' ?>
                    <input type="text" name="mail" value="<?= ($savedMail) ? $savedMail : '' ?>" required />
                </label>
                <label>
                    <?= defined('password') ? password : 'Password' ?>
                    <input type="password" name="actualPassword" required />
                </label>
                <input type="button" value="<?= defined('changePassword') ? changePassword : 'Change password' ?>" />

                <label>
                    <?= defined('password') ? password : 'New password' ?>
                    <input type="password" name="newPassword" />
                </label>
                <?php foreach ($profileErrors as $errorMessage) { ?>
                    <p><?= $errorMessage ?></p>
                <?php } ?>

                <input type="button" id="deleteUser" value="<?= defined('eraseAccount') ? eraseAccount : 'Erase account' ?>" />
                <input type="submit" name="update" value="<?= defined('save') ? save : 'Save' ?>" />
            </form>
            <form action="#" method="POST">
                <input type="submit" name="stopUpdate" value ="<?= defined('cancel') ? cancel : 'Cancel' ?>" />
            </form>
            <form action="#" method="POST">
                <input type="submit" name="deleteUserImage" value="<?= defined('eraseUserImage') ? eraseUserImage : 'Erase image' ?>" />
            </form>
        <?php } else { ?>
            <!-- VISUALISATION DU PROFILE -->

            <img src="<?= ($userImageExist) ? $savedUserImagePath : path::getUserImagesPath() . 'user-image.png' ?>" title="user image" alt="user image" />

            <h2><?= defined('username') ? username : 'Username' ?></h2>
            <?php if ($savedUsername) { ?>
                <p><?= $savedUsername ?></p>
            <?php } ?>

            <h2><?= defined('email') ? email : 'Mail' ?></h2>
            <?php if ($savedMail) { ?>
                <p><?= $savedMail ?></p>
            <?php } ?>
            <?php if ($canModify) { ?>
                <form action="#" method="POST">
                    <input type="submit" name="modify" value="Modifier" />
                </form>
                <?php
            }
        }
        ?>
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script src="assets/js/valueChecker.js"></script>
        <script src="assets/js/materializeInitializer.js"></script>
    </body>
</html>