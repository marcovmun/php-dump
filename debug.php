<?php
$directory = 'debug';
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
foreach ($scanned_directory as $file) {
    $handle = fopen($directory . DIRECTORY_SEPARATOR .  $file, 'r');
    if($handle === false) {
        continue;
    }
    while (!feof($handle)) {
        echo fgets($handle);
    }

    fclose($handle);
    unlink($directory . DIRECTORY_SEPARATOR . $file);
}
?>