<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:58 PM
 */

namespace marcovmun\openfile\editors;


class Phpstorm_editor extends Abstract_editor implements Editor_interface
{
    function execute(): bool
    {
        $args = '"' . $this->get_application_executable() . '" ';
        $args .= '"' . $this->get_file() . '"';
        if ($this->get_line_number() !== null) {
            $args .= ' --line ' . $this->get_line_number();
            $args .= ' "' . $this->get_file() . '"';
        }

        exec($args, $output, $return);
        if ($return === 0) {
            return true;
        } else {
            foreach ($output as $line) {
                echo $line;
            }
            throw new \Exception('Execution failid');
        }
    }

}