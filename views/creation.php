<?php
include_once '../classes/path.php';
include_once path::getControllersPath() . 'duel.php';

$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';
?>

<div class="container">
    <!-- mode selector begin -->
    <div class="row" id="modeSelector">
        <div class="col s4 offset-s4">
            <div class="col s2 offset-s2">
                <input id="php" name="mode" type="radio" checked/>
                <label for="php"><img src="../assets/images/php.png" /></label>
            </div>
            <div class="col s2">
                <input id="cpp" name="mode" type="radio" />
                <label for="cpp"><img src="../assets/images/cpp.png" /></label>
            </div>  
            <div class="col s2">
                <input id="c" name="mode" type="radio" />
                <label for="c"><img src="../assets/images/c.png" /></label>
            </div>  
            <div class="col s2">
                <input id="csharp" name="mode" type="radio" />
                <label for="csharp"><img src="../assets/images/csharp.png" /></label>
            </div>
        </div>
    </div>
    <!-- mode selector end -->
    
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

