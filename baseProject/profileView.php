<?php
session_start();
include_once 'assets/classes/path.php';
include path::getControllers() . 'profileController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Stephan Nicolas" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <script src="assets/js/import/jquery.min.js"></script>
        <script src="assets/js/import/popper.min.js"></script>
        <script src="assets/js/import/bootstrap.min.js"></script>
        <script src="assets/js/profile.js"></script>
        <title>QUIZ</title>
    </head>
    <body>
        <div id="pageTop">

        </div>                  
        <?php include path::getLayout() . 'navbar.php'; ?>
        <div class="container-fluid">
            <?php if ((!empty($_POST) && isset($_POST['modify'])) || count($profileErrors) != 0) { ?>
                <!-- MODIFICATION DU PROFILE -->
                <form id="modifyUser" action="" method="POST">
                    <div class="row mt-5">
                        <div class="offset-1 col-5">
                            <div class="row background-profile p-2">
                                <div class="col">
                                    <div class="row">
                                        <!-- user image -->
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col d-flex">
                                                    <div class="userImageContainer  mx-auto" style="background-color: <?= '#' . $profileUserInstance->color ?>">
                                                        <label for="newUserImage" class="file-input">      
                                                            <img class="userImage rounded-circle" src="<?= ($profileUserInstance->id != null && $userImageExist) ? path::getUserImages() . $profileUserInstance->id . '.png' : path::getUserImages() . 'user-image.png' ?>" title="user image" alt="user image" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($profileUserInstance->id != null && $userImageExist) { ?>
                                                <div class="row">
                                                    <div class="col align-content-center">
                                                        <button type="submit" name="deleteUserImage" class="d-flex m-auto">Supprimer</button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <input id="newUserImage" class="input-file" type="file" name="newUserImage"/>
                                        </div>
                                        <!-- user fields -->
                                        <div class="col">
                                            <!-- username -->
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <label for="username" class="required"><b>Nom d'utilisateur</b></label>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <input id="username" type="text" name="username" class="w-100" value="<?= $profileUserInstance->username ?>" />
                                                    <p class="text-danger"><?= isset($profileErrors['username']) ? $profileErrors['username'] : '' ?></p>
                                                </div>
                                            </div>
                                            <!-- mail -->
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <label for="mail" class="required"><b>Mail</b></label>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <input type="text" name="mail" value="<?= $profileUserInstance->mail ?>" />
                                                    <p class="text-danger"><?= isset($profileErrors['mail']) ? $profileErrors['mail'] : '' ?></p>
                                                </div>
                                            </div>
                                            <!-- actual password -->
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <label for="actualPassword" class="required"><b>Mot de passe actuel</b></label>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <input type="password" name="actualPassword" />
                                                    <p class="text-danger"><?= isset($profileErrors['actualPassword']) ? $profileErrors['actualPassword'] : '' ?></p>
                                                </div>
                                            </div>
                                            <!-- new password -->
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <button type="button" id="changePassword">Changer le mot de passe ?</button>
                                                </div>
                                            </div>
                                            <div id="changePasswordDiv">
                                                <div class="row mt-1">
                                                    <div class="col">
                                                        <label for="newPassword"><b>Nouveau mot de passe</b></label>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col">
                                                        <input type="password" name="newPassword" />
                                                        <p class="text-danger"><?= isset($profileErrors['newPassword']) ? $profileErrors['newPassword'] : '' ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <button type="button" id="deleteUser" class="w-100">Supprimer le compte</button>
                                        </div>
                                        <div class="offset-4 col-4">
                                            <button type="submit" name="stopUpdate">Annuler</button>
                                            <button type="submit" name="update">Enregistrer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } else { ?>
                <!-- VISUALISATION DU PROFILE -->
                <form action="" method="POST">
                    <div class="row mt-5">
                        <div class="offset-1 col-5">
                            <div class="row background-profile p-2">
                                <div class="col">
                                    <div class="row">
                                        <!-- user image -->
                                        <div class="col-4 d-flex">
                                            <div class="userImageContainer" style="background-color: <?= '#' . $profileUserInstance->color ?>">
                                                <img class="userImage rounded-circle  mx-auto" src="<?= ($profileUserInstance->id != null && $userImageExist) ? path::getUserImages() . $profileUserInstance->id . '.png' : path::getUserImages() . 'user-image.png' ?>" title="user image" alt="user image" />
                                            </div>
                                        </div>
                                        <!-- user fields -->
                                        <div class="col">
                                            <!-- username -->
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <label class="text-uppercase">nom d'utilisateur</label>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <p><?= $profileUserInstance->username ?></p>
                                                </div>
                                            </div>
                                            <!-- mail -->
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <label class="text-uppercase">mail</label>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col">
                                                    <p><?= $profileUserInstance->mail ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-10 col-2">
                                            <button type="submit" name="modify">Modifier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </body>
</html>