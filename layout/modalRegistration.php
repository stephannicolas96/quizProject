<?php include_once path::getControllersPath() . 'modalRegistration.php'; ?>
<div id="registrationModal" class="modal">
    <form id="registrationForm">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= SIGN_UP ?></h4>  
            <div class="errors hidden"></div>
            <div class="success hidden"><p><?= SUCCESSFUL_REGISTRATION ?></p></div>
            <div class="content">
                <?php foreach ($inputs as $inputData) { ?>
                    <div class="<?= $inputData->wrappingDivClasses ?>">
                        <input <?= $inputData->inputAttr ?> />
                        <label for="<?= $inputData->labelAttr ?>"><?= $inputData->labelContent ?></label>
                    </div>
                <?php } ?>
                <p><?= BY_CREATING_AN_ACCOUNT ?> <a href="#!"><?= TERMS_AND_PRIVACY ?></a>.</p>
            </div>
            <div class="loader large hidden"><img src="../assets/images/loading.gif"/></div>
        </div>
        <div class="modal-footer">
            <input id="registrationSubmit" class="modal-action btn-flat" type="submit" value="<?= REGISTRATION ?>" />
        </div>
    </form>
</div>


