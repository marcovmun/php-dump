<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 14-Dec-16
 * Time: 22:18 PM
 */

define('ROOT', __DIR__ .
    DIRECTORY_SEPARATOR .
    '..' .
    DIRECTORY_SEPARATOR
);

use marcovmun\phpdump\Html_dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @return string
 */
function get_new_file(): string
{
    $time = time() . microtime();
    $debug_map = '/var/phpdump/dumpfiles/';

    return $debug_map . $time . '.html';
}

VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner();
    $dumper = Html_dumper::instance();
    $dumper->setOutput(get_new_file());
    $dumper->dump($cloner->cloneVar($var));
});