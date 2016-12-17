<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:50 PM
 */

namespace marcovmun\openfile\editors;


interface Editor_interface
{
    /**
     * @param string $file
     * @return void
     */
    function set_file(string $file);

    /**
     * @param int $line_number
     */
    function set_line_number(int $line_number);

    /**
     * Set on which environment you are:
     * Windows}linux}OSX
     */
    function set_environment();

    /**
     * Set the location of the executable that has to be called to open a file
     * @param string $location
     */
    function set_application_executable(string $location);

    /**
     * Open file in editor
     * @return bool : true or exception
     */
    function execute(): bool;
}