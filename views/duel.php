<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'duel.php';

$pageTitle = 'BATTLE';
include path::getLayoutPath() . 'header.php';
?>
<div class="big-container">
    <div class="duelSplit">
        <img id="duelLangageImg" src="../assets/images/langages/<?= $langageId ?>" data-langageId="<?= $langageId ?>"/>
        <div id="question">
            <p class="questionTitle"><?= ENUNCIATED ?></p>
            <pre><?= $questionInstance->enunciated ?></pre>
            <p class="questionTitle"><?= INPUT ?></p>
            <pre><?= $questionInstance->input ?></pre>
            <p class="questionTitle"><?= OUTPUT ?></p>
            <pre><?= $questionInstance->output ?></pre>
        </div>
        <div class="editor" id="duelEditor"></div>
        <div class="editorError"></div>
    </div>
    <button id="duelSubmit" class="btn-flat"><?= TEST_YOUR_CODE ?></button> 
</div>
<?php include path::getLayoutPath() . 'footer.php'; ?>