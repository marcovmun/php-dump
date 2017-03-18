<?php
/**
 * User: marco
 * Date: 17-Dec-16
 * Time: 21:59 PM
 */

namespace marcovmun\openfile\editors;

/**
 * Class AbstractEditor
 * @package marcovmun\openfile\editors
 */
abstract class AbstractEditor implements EditorInterface
{
    /**
     * @var int
     */
    private $lineNumber;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $applicationExecutable;

    /**
     * @return int
     */
    public function getLineNumber(): int
    {
        return $this->lineNumber;
    }

    /**
     * @param int $lineNumber
     */
    public function setLineNumber(int $lineNumber)
    {
        $this->lineNumber = $lineNumber;
    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile(string $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getApplicationExecutable(): string
    {
        return $this->applicationExecutable;
    }

    /**
     * @param string $applicationExecutable
     */
    public function setApplicationExecutable(string $applicationExecutable)
    {
        $this->applicationExecutable = $applicationExecutable;
    }
}
