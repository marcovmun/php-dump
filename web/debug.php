<?php
error_reporting(0);
$directory = '/var/phpdump/dumpfiles/';
$scannedDirectory = array_diff(scandir($directory), ['..', '.']);
$now = time();
foreach ($scannedDirectory as $file) {
    $time = filemtime($directory . $file);
    if ($time >= $now) { //only get files that are note edited any more
        continue;
    }
    $handle = fopen($directory . DIRECTORY_SEPARATOR . $file, 'r');
    if ($handle === false) {
        continue;
    }
    while (!feof($handle)) {
        echo fgets($handle);
    }
    fclose($handle);
    do {
        unlink($directory . DIRECTORY_SEPARATOR . $file);
    } while (file_exists($directory . DIRECTORY_SEPARATOR . $file));
}
