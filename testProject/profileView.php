<?php
session_start();
include_once 'assets/classes/path.php';
include path::getControllersPath() . 'logoutController.php';
include path::getLangagePath() . 'fr_FR.php'; //TEMP REMOVE
include path::getControllersPath() . 'profileController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <title>TODO: FIND A TITLE FOR THIS PAGE</title>
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

                <label for="username"><?= defined('username') ? username : 'Username' ?></label>
                <input id="username" type="text" name="username"  value="<?= ($savedUsername) ? $savedUsername : '' ?>" required />

                <label for="mail"><?= defined('mail') ? mail : 'Mail' ?></label>
                <input id="mail" type="text" name="mail" value="<?= ($savedMail) ? $savedMail : '' ?>" required />

                <label for="actualPassword"><?= defined('password') ? password : 'Password' ?></label>
                <input id="actualPassword" type="password" name="actualPassword" required />
                <input type="button" value="<?= defined('changePassword') ? changePassword : 'Change password' ?>" />

                <label for="newPassword"><?= defined('password') ? password : 'New password' ?></label>
                <input id="newPassword" type="password" name="newPassword" />

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

            <h2><?= defined('mail') ? mail : 'Mail' ?></h2>
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
    </body>
</html>