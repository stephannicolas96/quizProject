<?php
include_once path::getControllersPath() . 'loginController.php';
?>
<div id="loginModal" class="modal modal-fixed-footer">
    <form id="loginForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('logIn') ? logIn : 'Log In' ?></h4>  
            <div class="container">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="login" type="email" name="login" value="<?= !empty($loginUserInstance->email) ? $loginUserInstance->email : '' ?>" required maxlength="50"/>
                        <label for="login"><?= defined('email') ? email : 'Email' ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="loginPassword" type="password" name="loginPassword" required maxlength="60"/>
                        <label for="loginPassword"><?= defined('password') ? password : 'Password' ?></label>
                    </div>
                </div>
                <?php if (!$loginSuccess) { // login failed show all error messages ?>
                    <div class="row">
                        <div class="col s12">
                            <?php
                            foreach ($loginErrors as $errorMessage) {
                                ?>
                                <p><?= $errorMessage ?></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { // show a successful login message ?>        
                    <p><?= defined('successfulLogin') ? successfulLogin : 'Login sucessful !' ?></p>   
                <?php } ?>
            </div>
        </div>
        <div class="modal-footer">
            <input class="modal-action waves-effect waves-green btn-flat" type="submit" name="signIn" value="<?= defined('submit') ? submit : 'Sign in' ?>" />
        </div>
        <p><?= defined('noAccount') ? noAccount : 'No account?' ?></p><a href="registrationView.php"><?= defined('createOne') ? createOne : 'Create one!' ?></a>
        <a href="forgotPasswordView.php"><?= defined('forgotPassword') ? forgotPassword : 'Forgot your password?' ?></a>
    </form>
</div>





