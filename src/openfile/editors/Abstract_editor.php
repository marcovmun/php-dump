<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:59 PM
 */

namespace marcovmun\openfile\editors;


class Abstract_editor
{
    /** @var int  */
    private $line_number;

    /** @var string */
    private $file;

    /** @var void */
    private $environment;

    /** @var string */
    private $application_executable;

    /**
     * @return int
     */
    public function get_line_number(): int
    {
        return $this->line_number;
    }

    /**
     * @param int $line_number
     */
    public function set_line_number(int $line_number)
    {
        $this->line_number = $line_number;
    }

    /**
     * @return string
     */
    public function get_file(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function set_file(string $file)
    {
        $this->file = $file;
    }

    /**
     */
    public function get_environment()
    {
    }

    /**
     */
    public function set_environment()
    {
    }

    /**
     * @return string
     */
    public function get_application_executable(): string
    {
        return $this->application_executable;
    }

    /**
     * @param string $application_executable
     */
    public function set_application_executable(string $application_executable)
    {
        $this->application_executable = $application_executable;
    }



}