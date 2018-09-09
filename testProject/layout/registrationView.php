<?php
include_once path::getControllersPath() . 'registrationController.php';
?>
<div id="registrationModal" class="modal modal-fixed-footer">
    <form id="registrationForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('signUp') ? signUp : 'Registration' ?></h4>  
            <div class="container">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="username" type="text" name="username" value="<?= !empty($registrationUserInstance->username) ? $registrationUserInstance->username : '' ?>" required maxlength="30"/>
                        <label for="username"><?= defined('username') ? username : 'Username' ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="email" type="email" name="email" value="<?= !empty($registrationUserInstance->email) ? $registrationUserInstance->email : '' ?>" required maxlength="50"/>
                        <label for="email"><?= defined('email') ? email : 'Email' ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="registrationPassword" type="password" name="password" required maxlength="60"/>
                        <label for="registrationPassword"><?= defined('password') ? password : 'Password' ?></label>
                        <input type="button" value="show">
                    </div>
                </div>
                <?php if (!$loginSuccess) { // login failed show all error messages ?>
                    <div class="row">
                        <div class="col s12">
                            <?php
                            foreach ($registrationErrors as $errorMessage) {
                                ?>
                                <p><?= $errorMessage ?></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                <?php } else { // show a successful login message ?>                
                    <p><?= defined('successfulRegistration') ? successfulRegistration : 'Registration sucessful, you can try to connect yourself !' ?></p>   
                <?php } ?>
            </div>
            <p><?= defined('byCreatingAnAccount') ? byCreatingAnAccount : 'By creating an account you agree to our' ?><a href="#"><?= defined('termsAndPrivacy') ? termsAndPrivacy : 'Terms & Privacy' ?></a>.</p>
        </div>
        <div class="modal-footer">
            <input class="modal-action waves-effect waves-green btn-flat" type="submit" name="register" value="<?= defined('submit') ? submit : 'Register' ?>" />
        </div>
        <p><?= defined('alreadyHaveAnAccount') ? alreadyHaveAnAccount : 'Already have an account?' ?><a href="loginView.php"><?= defined('clickHereToConnect') ? clickHereToConnect : 'Sign in' ?></a>.</p>
    </form>
</div>