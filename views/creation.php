<?php
include_once '../classes/path.php';

$pageBackground = '';
$pageTitle = '';
$controllerToLoad = 'duel.php';
include path::getLayoutPath() . 'header.php';
?>

<?php include path::getLayoutPath() . 'modeSelector.php' ?>
<div class="md-container">
    <ul class="collapsible">
        <li>
            <div class="collapsible-header active">
                <p>QUESTION</p>
                <i class="material-icons hidden">warning</i>
                <i class="material-icons">info</i>
            </div>
            <div class="collapsible-body editor" id="questionEditor"></div>
        </li>
        <li>
            <div class="collapsible-header">
                <p>CODE</p>
                <i class="material-icons hidden">warning</i>
                <i class="material-icons">info</i>
            </div>
            <div class="collapsible-body editor" id="codeEditor"></div>
        </li>
        <li class="relative">
            <div class="collapsible-header">
                <p>INPUT</p>
                <i class="material-icons hidden">warning</i>
                <i class="material-icons">info</i>
            </div>
            <div class="collapsible-body editor" id="inputEditor"></div>
            <div id="inputExample" class="opened">
                <p class="content"></p>
                <div class="loader hidden"><img src="../assets/images/loading.gif"/></div>
            </div>
        </li>
    </ul>
</div>
<div id="error"></div>
<button id="action">Lancer la requête AJAX</button> 
<?php include path::getLayoutPath() . 'footer.php'; ?>

