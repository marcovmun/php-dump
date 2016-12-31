<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 14-Dec-16
 * Time: 22:18 PM
 */

define('ROOT', __DIR__ . '/../');

use marcovmun\phpdump\Html_dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @return string
 */
function get_new_file(): string
{
    $time = time() . microtime();
    $location = substr(__DIR__, 0, -strlen('app'));
    $debug_map = $location . 'debug' . DIRECTORY_SEPARATOR;

    return $debug_map . $time . '.html';
}

VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner();
    $dumper = Html_dumper::instance();
    $dumper->setOutput(get_new_file());
    $dumper->dump($cloner->cloneVar($var));
});