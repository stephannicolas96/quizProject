<?php
//PHP COMPILER
$tempFile = tmpfile();
$output = null;
$code = '<?php ' . $_POST['code'];
fwrite($tempFile, $code);
$output = shell_exec('php ' . stream_get_meta_data($tempFile)['uri'] . ' 125 70 127 220 0.5 0.4');
var_dump($output);
fclose($tempFile);