<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:46 PM
 */

use marcovmun\phpdump\Html_dumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * @param string $num
 * @param string $str
 * @param string $file
 * @param string $line
 * @param null $context
 */
function log_error($num, $str, $file, $line, $context = null)
{
    log_exception(new ErrorException($str, 0, $num, $file, $line));
}

/**
 * @param Exception $e
 */
function log_exception($e)
{
    $extraDisplayOptions = [
        'file' => $e->getFile(),
        'file_number' => $e->getLine(),
    ];
    $cloner = new VarCloner();
    $dumper = Html_dumper::instance();
    $dumper->setOutput(get_new_file());
    $dumper->dump($cloner->cloneVar($e), null, $extraDisplayOptions);
}

/**
 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
 */
function check_for_fatal()
{
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        log_error($error["type"], $error["message"], $error["file"], $error["line"]);
    }
}

register_shutdown_function("check_for_fatal");
set_error_handler("log_error");
set_exception_handler("log_exception");
ini_set("display_errors", "off");
error_reporting(E_ALL);