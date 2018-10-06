<?php
include_once 'classes/path.php';
$pageBackground = '';
$pageTitle = '';
include path::getLayoutPath() . 'header.php';
for($i = 0; $i < 256; $i++){
    echo $i . ' = ' . chr($i) . '<br>';
}
?>
<?php include path::getLayoutPath() . 'footer.php'; ?>



