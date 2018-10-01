<div id="loginModal" class="modal modal-fixed-footer">
    <form id="loginForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('LOG_IN') ? LOG_IN : 'Log In' ?></h4>  
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="login" type="email" name="login" value="<?= !empty($loginUserInstance->email) ? $loginUserInstance->email : '' ?>" required maxlength="50"/>
                            <label for="login"><?= defined('EMAIL') ? EMAIL : 'Email' ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 password">
                            <input id="loginPassword" name="loginPassword" type="password" maxlength="60" required/>
                            <label for="loginPassword"><?= defined('PASSWORD') ? PASSWORD : 'Password' ?></label>
                        </div>
                    </div>
                </div>
                <div class="row errors">
                    <div class="col s12"></div>
                </div>
                <div class="row">
                    <div class="col s12 g-recaptcha" data-sitekey="sitekey"></div>
                </div>
            </div>
            <div class="success">
                <p><?= defined('SUCCESSFUL_LOG_IN') ? SUCCESSFUL_LOG_IN : 'Login sucessful !' ?></p>   
            </div>
            <div class="loader">
                <img src="../assets/images/loading.gif"/>
            </div>
            <p><?= defined('NO_ACCOUNT') ? NO_ACCOUNT : 'No account?' ?></p><a href="registrationView.php"><?= defined('CREATE_ONE') ? CREATE_ONE : 'Create one!' ?></a>
            <a href="forgotPasswordView.php"><?= defined('FORGOT_PASSWORD') ? FORGOT_PASSWORD : 'Forgot your password?' ?></a>
        </div>
        <div class="modal-footer">
            <input id="loginSubmit" class="modal-action waves-effect waves-green btn-flat" type="button" name="signIn" value="<?= defined('SUBMIT') ? SUBMIT : 'Submit' ?>" />
        </div>
    </form>
</div>