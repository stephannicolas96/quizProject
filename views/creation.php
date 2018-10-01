<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'duel.php';

$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';
?>

<?php include path::getLayoutPath() . 'modeSelector.php' ?>
<div class="md-container">
    <ul class="collapsible">
        <li>
            <div class="collapsible-header active">QUESTION</div>
            <div class="collapsible-body editor" id="questionEditor"></div>
        </li>
        <li>
            <div class="collapsible-header">CODE</div>
            <div class="collapsible-body editor" id="codeEditor"></div>
        </li>
        <li class="relative">
            <div class="collapsible-header">INPUT</div>
            <div class="collapsible-body editor" id="inputEditor"></div>
            <div id="inputExample" class="opened"><p class="content"></p></div>
        </li>
    </ul>
</div>
<div id="error"></div>
<button id="action">Lancer la requête AJAX</button> 
<?php include path::getLayoutPath() . 'footer.php'; ?>

