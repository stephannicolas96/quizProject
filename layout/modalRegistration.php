<div id="registrationModal" class="modal modal-fixed-footer">
    <form id="registrationForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= defined('SIGN_UP') ? SIGN_UP : 'Registration' ?></h4>  
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" type="text" name="username" value="<?= !empty($registrationUserInstance->username) ? $registrationUserInstance->username : '' ?>" required maxlength="30"/>
                            <label for="username"><?= defined('USERNAME') ? USERNAME : 'Username' ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" value="<?= !empty($registrationUserInstance->email) ? $registrationUserInstance->email : '' ?>" required maxlength="50"/>
                            <label for="email"><?= defined('EMAIL') ? EMAIL : 'Email' ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="registrationPassword" type="password" name="password" required maxlength="60"/>
                            <label for="registrationPassword"><?= defined('PASSWORD') ? PASSWORD : 'Password' ?></label>
                            <button id="registrationPasswordVisibility" type="button"><i class="fas fa-eye"></i></button>
                            <div id="passwordDifficultyProgressBar">
                                <div id="passwordDifficultyProgressBarForeground"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row errors">
                    <div class="col s12"></div>
                </div>
                <div class="row success">
                    <div>
                        <p><?= defined('SUCCESSFUL_REGISTRATION') ? SUCCESSFUL_REGISTRATION : 'Registration sucessful, you can try to connect yourself !' ?></p>
                    </div>
                </div>
                <div class="row loader">
                    <div class="col s12">
                        <img src="../assets/images/loading.gif"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <p><?= defined('BY_CREATING_AN_ACCOUNT') ? BY_CREATING_AN_ACCOUNT : 'By creating an account you agree to our' ?><a href="#"><?= defined('TERMS_AND_PRIVACY') ? TERMS_AND_PRIVACY : 'Terms & Privacy' ?></a>.</p>
                    </div>
                    <div class="col s12">
                        <p class="mt-3"><?= defined('ALREADY_HAVE_AN_ACCOUNT') ? ALREADY_HAVE_AN_ACCOUNT : 'Already have an account?' ?><a class="link" data-dismiss="modal" data-toggle="modal" href="#loginModal"><?= defined('LOG_IN') ? LOG_IN : 'Log In' ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input id="registrationSubmit" class="modal-action waves-effect waves-green btn-flat" type="button" name="register" value="<?= defined('SUBMIT') ? SUBMIT : 'Submit' ?>" />
        </div>
    </form>
</div>


