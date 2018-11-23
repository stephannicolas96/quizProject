<?php include_once path::getControllersPath() . 'modalLogin.php'; ?>
<div id="loginModal" class="modal">
    <form id="loginForm" action="#" method="POST">
        <div class="modal-content">
            <h4 class="modal-title large-font"><?= LOG_IN ?></h4>  
            <div class="errors hidden"></div>
            <div class="success hidden"><p><?= SUCCESSFUL_LOG_IN ?></p></div>
            <div class="content">
                <?php foreach ($inputs as $inputData) { ?>
                    <div class="<?= $inputData->wrappingDivClasses ?>">
                        <input <?= $inputData->inputAttr ?> />
                        <label for="<?= $inputData->labelAttr ?>"><?= $inputData->labelContent ?></label>
                    </div>
                <?php } ?>
            </div>
            <div class="loader large hidden"><img src="../assets/images/loading.gif"/></div>
        </div>
        <div class="modal-footer">
            <input id="loginSubmit" class="modal-action btn-flat" type="submit" value="<?= CONNEXION ?>" />
        </div>
    </form>
</div>