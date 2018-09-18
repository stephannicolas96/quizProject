<div id="loginModal" class="modal modal-fixed-footer">
    <form id="loginForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('logIn') ? logIn : 'Log In' ?></h4>  
            <div class="container">
                <div class="content">
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
                            <button id="loginPasswordVisibility" type="button"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row errors">
                    <div class="col s12"></div>
                </div>
            </div>
            <div class="success">
                <p><?= defined('successfulLogin') ? successfulLogin : 'Login sucessful !' ?></p>   
            </div>
            <div class="loader">
                <img src="assets/images/loading.gif"/>
            </div>
        </div>
        <div class="modal-footer">
            <input id="loginSubmit" class="modal-action waves-effect waves-green btn-flat" type="button" name="signIn" value="<?= defined('submit') ? submit : 'Submit' ?>" />
        </div>
    </form>
</div>


<p><?= defined('noAccount') ? noAccount : 'No account?' ?></p><a href="registrationView.php"><?= defined('createOne') ? createOne : 'Create one!' ?></a>
<a href="forgotPasswordView.php"><?= defined('forgotPassword') ? forgotPassword : 'Forgot your password?' ?></a>






