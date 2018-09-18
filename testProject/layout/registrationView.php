<div id="registrationModal" class="modal modal-fixed-footer">
    <form id="registrationForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('signUp') ? signUp : 'Registration' ?></h4>  
            <div class="container">
                <div class="content">
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
                            <button id="registrationPasswordVisibility" type="button"><i class="fas fa-eye"></i></button>
                            <div id="passwordDifficultyProgressBar">
                                <div id="passwordDifficultyProgressBarForeground"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <p><?= defined('byCreatingAnAccount') ? byCreatingAnAccount : 'By creating an account you agree to our' ?><a href="#"><?= defined('termsAndPrivacy') ? termsAndPrivacy : 'Terms & Privacy' ?></a>.</p>
                        </div>
                    </div>
                </div>
                <div class="row errors">
                    <div class="col s12"></div>
                </div>
            </div>
            <div class="success">
                <p><?= defined('successfulRegistration') ? successfulRegistration : 'Registration sucessful, you can try to connect yourself !' ?></p>
            </div>
            <div class="loader">
                <img src="assets/images/loading.gif"/>
            </div>
        </div>
        <div class="modal-footer">
            <input id="registrationSubmit" class="modal-action waves-effect waves-green btn-flat" type="button" name="register" value="<?= defined('submit') ? submit : 'Submit' ?>" />
        </div>
    </form>
</div>


<p class="mt-3"><?= defined('alreadyHaveAnAccount') ? alreadyHaveAnAccount : 'Already have an account?' ?><a class="link" data-dismiss="modal" data-toggle="modal" href="#loginModal"><?= defined('logIn') ? logIn : 'Log In' ?></a></p>
