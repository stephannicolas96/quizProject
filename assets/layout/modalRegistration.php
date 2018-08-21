<?php
include_once path::getControllers() . 'registrationController.php';
?>
<form id="registationForm" action="index.php" method="POST">
    <div class="modal" id="registrationModal">
        <div class="modal-dialog">
            <div class="modal-content container-fluid">
                <!-- Modal Header -->
                <div class="modal-header d-block text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title large-font">Register</h4>   
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <?php if (!$registrationSuccess) { ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col pt-2">
                                        <label for="mail" class="required"><b>Nom d'utilisateur</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="w-100" type="text" placeholder="Enter Username" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" required>
                                        <p class="text-danger"><?= isset($registrationErrors['username']) ? $registrationErrors['username'] : '' ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pt-2">
                                        <label for="mail" class="required"><b>Email</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="w-100" type="text" placeholder="Enter Email" name="mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>" required>
                                        <p class="text-danger"><?= isset($registrationErrors['mail']) ? $registrationErrors['mail'] : '' ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pt-2">
                                        <label for="password" class="required"><b>Password</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="w-100" type="password" placeholder="Enter Password" name="password" required>
                                        <p class="text-danger"><?= isset($registrationErrors['password']) ? $registrationErrors['password'] : '' ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pt-2">
                                        <label for="confirmPassword" class="required"><b>Repeat Password</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input class="w-100" type="password" placeholder="Repeat Password" name="confirmPassword" required>
                                        <p class="text-danger"><?= isset($registrationErrors['confirmPassword']) ? $registrationErrors['confirmPassword'] : '' ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p class="text-success">L'inscription a bien été prise en compte, vous pouvez vous connecter !</p>   
                    <?php } ?>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer d-block text-center">
                    <?php if (!$registrationSuccess) { ?>
                        <p>By creating an account you agree to our <a class="link" href="#">Terms & Privacy</a>.</p>
                        <button type="submit" name="register" class="btn btn-warning w-100 m-0 p-2">Register</button>
                        <p class="mt-3">Already have an account? <a class="link" data-dismiss="modal" data-toggle="modal" href="#loginModal">Sign in</a>.</p>
                    <?php } ?>
                </div>
            </div>
        </div> 
    </div>
</form>
<script><?php
if ($registrationSuccess || count($registrationErrors) > 0) {
    echo '$(\'#registrationModal\').modal(\'show\')';
    $registrationSuccess = false;
    unset($registrationErrors);
}
?></script>
