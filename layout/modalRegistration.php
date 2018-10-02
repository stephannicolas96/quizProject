<?php include_once path::getControllersPath() . 'modalRegistration.php'; ?>
<div id="registrationModal" class="modal modal-fixed-footer">
    <form id="registrationForm">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= SIGN_UP ?></h4>  
            <div class="content">
                <?php foreach ($inputs as $inputData) { ?>
                    <div class="<?= $inputData->wrappingDivClasses ?>">
                        <input <?= $inputData->inputAttr ?> />
                        <label for="<?= $inputData->labelAttr ?>"><?= $inputData->labelContent ?></label>
                    </div>
                <?php } ?>
            </div>
            <div class="errors"></div>
            <div class="success"><p><?= SUCCESSFUL_REGISTRATION ?></p></div>
            <div class="loader"><img src="../assets/images/loading.gif"/></div>
            <p><?= BY_CREATING_AN_ACCOUNT ?> <a href="#!"><?= TERMS_AND_PRIVACY ?></a>.</p>
            <p class="mt-3"><?= ALREADY_HAVE_AN_ACCOUNT ?> <a class="modal-trigger modal-close" href="#loginModal"><?= LOG_IN ?></a></p>
        </div>
        <div class="modal-footer">
            <input id="registrationSubmit" class="modal-action waves-effect waves-green btn-flat" type="button" name="register" value="<?= SUBMIT ?>" />
        </div>
    </form>
</div>


