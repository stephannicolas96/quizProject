<?php
include_once path::getControllers() . 'loginController.php';
?>
<form id="loginForm" action="index.php" method="POST">
    <div class="modal" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content container-fluid">
                <!-- Modal Header -->
                <div class="modal-header d-block text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title large-font">Log in</h4>   
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 white-bg">
                            <p class="text-danger"><?= isset($loginErrors['connexion']) ? $loginErrors['connexion'] : '' ?></p>
                            <div class="row">
                                <div class="col pt-2">
                                    <label for="login"><b>Email/Nom d'utilisateur</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="w-100" type="text" placeholder="Enter Email Or Username" name="login" value="<?= ($previousLogin) ? $previousLogin : null ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pt-2">
                                    <label for="password"><b>Password</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input class="w-100" type="password" placeholder="Enter Password" name="password" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer d-block text-center">
                    <button type="submit" name="connect" class="btn btn-warning w-100 m-0 p-2">Sign in</button>
                    <p class="mt-3">No account? <a class="link" data-dismiss="modal" data-toggle="modal" href="#registrationModal">Create one!</a></p>
                    <a class="mt-3 link" data-dismiss="modal" data-toggle="modal" href="#forgotPasswordModal">Forgot your password?</a>
                </div>
            </div>
        </div> 
    </div>
</form>
<script><?php
if (count($loginErrors) > 0) {
    echo '$(\'#loginModal\').modal(\'show\')';
    unset($loginErrors);
}
?></script>