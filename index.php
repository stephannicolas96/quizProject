<?php
include_once 'classes/path.php';
$pageTitle = 'HOME';
include path::getLayoutPath() . 'header.php';
?>
<?php if(!$isLogged) { ?>
<div class="split middleBorder">
    <div id="registrationIndex">
        <p><?= NOT_REGISTERED_YET ?></p>
        <a class="modal-trigger" href="#registrationModal"><img class="indexImg" src="../assets/images/logo" /><span><?= REGISTRATION ?></span></a>
    </div>
    <div id="loginIndex">
        <p><?= LOG_IN_NOW ?></p>
        <a class="modal-trigger" href="#loginModal"><img class="indexImg" src="../assets/images/logo" /><span><?= LOG_IN ?></span></a>
    </div>
</div>
<?php } else { ?>
<?php } ?>
<?php include path::getLayoutPath() . 'footer.php'; ?>



