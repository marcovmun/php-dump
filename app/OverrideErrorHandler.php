<?php
/**
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:46 PM
 */

use marcovmun\phpdump\HtmlDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * @param string $num
 * @param string $str
 * @param string $file
 * @param string $line
 * @param null   $context
 */
function logError($num, $str, $file, $line, $context = null)
{
    logException(new ErrorException($str, 0, $num, $file, $line));
}

/**
 * @param Throwable $e
 */
function logException(Throwable $e)
{
    $extraDisplayOptions = [
        'file'        => $e->getFile(),
        'file_number' => $e->getLine(),
    ];
    $cloner = new VarCloner();
    $dumper = HtmlDumper::instance();
    $dumper->setOutput(get_new_file());
    $dumper->dump($cloner->cloneVar($e), null, $extraDisplayOptions);
}

/**
 * Checks for a fatal error, work around for set_error_handler not working on fatal errors.
 */
function checkForFatal()
{
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        logError($error["type"], $error["message"], $error["file"], $error["line"]);
    }
}

register_shutdown_function("checkForFatal");
set_error_handler("logError");
set_exception_handler("logException");
ini_set("display_errors", "off");
error_reporting(E_ALL);
