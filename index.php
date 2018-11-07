<?php
include_once 'classes/path.php';
$pageTitle = 'HOME';
include path::getLayoutPath() . 'header.php';

/*include_once path::getClassesPath() . 'database.php';
$a = database::getInstance()->query('show columns from T7rDZC_duel');
$a = $a->fetchAll(PDO::FETCH_OBJ);
var_dump($a);*/
?>
<h1>Welcome to BATTLELY</h1> <!-- TODO TRAD -->
<!--<p>If you've always wanted to test your programming level against other<p>-->
<?php include path::getLayoutPath() . 'footer.php'; ?>



