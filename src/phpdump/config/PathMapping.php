<?php
/**
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:16 PM
 */

namespace marcovmun\phpdump\config;

/**
 * Class PathMapping
 * @package marcovmun\phpdump\config
 */
class PathMapping
{
    /**
     * @var string
     */
    private $remote;

    /**
     * @var string
     */
    private $host;

    public function __construct(string $remote, string $host)
    {
        $this->remote = $remote;
        $this->host = $host;
    }

    /**
     * @param string $path
     */
    public function hostifyPath(string &$path)
    {
        $length = strlen($this->remote);

        if (substr($path, 0, $length) === $this->remote) {
            $path = $this->host . substr($path, $length);
        }
    }
}
