<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'duel.php';

$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';
?>

<div class="container">
    <?php include path::getLayoutPath() . 'modeSelector.php' ?>
    <div class="row">
        <div class="col s3">
            <div id="questionEditor"></div>
        </div>
        <div class="col s7">
            <div id="codeEditor"></div>
        </div>
        <div class="col s2" id="inputEditorContainer">
            <div id="inputEditor"></div>
            <div id="inputExample" class="opened"><p class="content"></p></div>
        </div>
    </div>
</div>
<div id="error"></div>
<button id="action">Lancer la requête AJAX</button> 
<?php include path::getLayoutPath() . 'footer.php'; ?>

