<?php
include_once '../classes/path.php';
$pageTitle = 'CREATE';
include path::getLayoutPath() . 'header.php';
?>
<?php include path::getLayoutPath() . 'modeSelector.php' ?>
<div class="md-container">
    <ul class="collapsible">
        <li>
            <div class="collapsible-header active">
                <p><?= QUESTION ?></p>
                <i class="warning material-icons hidden" data-position="right" data-tooltip="">warning</i>
                <i class="material-icons tooltipped" data-position="left" data-tooltip="<?= QUESTION_INFO ?>">info</i>
            </div>
            <div class="collapsible-body editor" id="questionEditor"></div>
        </li>
        <li class="relative">
            <div class="collapsible-header">
                <p><?= INPUT ?></p>
                <i class="warning material-icons hidden" data-position="right" data-tooltip="">warning</i>
                <i class="material-icons tooltipped" data-position="left" data-tooltip="<?= INPUT_INFO ?>">info</i>
            </div>
            <div class="collapsible-body editor" id="inputEditor"></div>
            <div id="inputExample" class="opened">
                <p class="content"></p>
                <div class="loader hidden"><img src="../assets/images/loading.gif"/></div>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <p><?= CODE ?></p>
                <i class="warning material-icons hidden" data-position="right" data-tooltip="">warning</i>
                <i class="material-icons tooltipped" data-position="left" data-tooltip="<?= CODE_INFO ?>">info</i>
            </div>
            <div class="collapsible-body editor" id="codeEditor"></div>
        </li>
    </ul>
    <div id="questionErrors" class="errors hidden"></div>
    <div id="questionSuccess" class="success hidden"><p><?= QUESTION_REGISTERED ?></p></div>
    <button id="register"><?= REGISTER_QUESTION ?></button> 
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>

