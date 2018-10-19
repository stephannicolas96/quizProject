<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'duel.php';

$pageTitle = 'BATTLE';
include path::getLayoutPath() . 'header.php';
?>
<div class="big-container">
    <img id="duelLangageImg" src="../assets/images/langages/<?= $langageId ?>.png" data-langageId="<?= $langageId ?>"/>
    <div class="duelSplit">
        <div id="question">
            <p>Enunciated</p>
            <p><?= $questionInstance->enunciated ?></p>
            <p>Inpout</p>
            <p><?= $questionInstance->input ?></p>
            <p>Output</p>
            <p><?= $questionInstance->output ?></p>
        </div>
        <div class="editor" id="duelEditor"></div>
    </div>
    <div class="error"></div>
</div>
<button id="duelSubmit">Lancer la requête AJAX</button> 
<?php include path::getLayoutPath() . 'footer.php'; ?>
