<?php
error_reporting(0);
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
    do {
        unlink($directory . DIRECTORY_SEPARATOR . $file);
    } while(file_exists($directory . DIRECTORY_SEPARATOR .  $file));
}
