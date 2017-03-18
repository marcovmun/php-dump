<?php
/**
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:58 PM
 */

namespace marcovmun\openfile\editors;

/**
 * Class Phpstorm_editor
 * @package marcovmun\openfile\editors
 */
class Phpstorm_editor extends AbstractEditor
{
    /**
     * @return bool
     * @throws \Exception
     */
    public function execute(): bool
    {
        $args = '"' . $this->getApplicationExecutable() . '" ';
        $args .= '"' . $this->getFile() . '"';
        if ($this->getLineNumber() !== null) {
            $args .= ' --line ' . $this->getLineNumber();
            $args .= ' "' . $this->getFile() . '"';
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

    /**
     * Set on which environment you are:
     * Windows}linux}OSX
     */
    public function setEnvironment()
    {
        throw new \Exception('Not implemented');
    }
}
