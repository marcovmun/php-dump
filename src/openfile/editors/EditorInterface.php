<?php
/**
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:50 PM
 */

namespace marcovmun\openfile\editors;

/**
 * Interface EditorInterface
 * @package marcovmun\openfile\editors
 */
interface EditorInterface
{
    /**
     * @param string $file
     *
     * @return void
     */
    public function setFile(string $file);

    /**
     * @param int $line_number
     */
    public function setLineNumber(int $line_number);

    /**
     * Set on which environment you are:
     * Windows}linux}OSX
     */
    public function setEnvironment();

    /**
     * Set the location of the executable that has to be called to open a file
     *
     * @param string $location
     */
    public function setApplicationExecutable(string $location);

    /**
     * Open file in editor
     * @return bool : true or exception
     */
    public function execute(): bool;
}
