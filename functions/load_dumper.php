<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 14-Dec-16
 * Time: 22:18 PM
 */

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use Symfony\Component\VarDumper\VarDumper;

VarDumper::setHandler(function ($var) {
    $cloner = new VarCloner();
    $html_dumper = new HtmlDumper();
    $time = time() . microtime();
    $location = substr(__DIR__, 0, -strlen('functions'));
    $debug_map = $location . 'debug' . DIRECTORY_SEPARATOR;
    $html_dumper->setOutput($debug_map . $time . '.html');
    $dumper = 'cli' === PHP_SAPI ? new CliDumper() :$html_dumper;

    $dumper->dump($cloner->cloneVar($var));
});