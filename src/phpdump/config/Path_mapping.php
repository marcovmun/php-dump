<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:16 PM
 */

namespace marcovmun\phpdump\config;


class Path_mapping
{
    private $remote;

    private $host;

    public function __construct(string $remote, $host)
    {
        $this->remote = $remote;
        $this->host = $host;
    }

    /**
     * @param string $path
     * @return string
     */
    public function hostify_path(string &$path)
    {
        $length = strlen($this->remote);

        if (substr($path, 0, $length) === $this->remote) {
            return $this->host . substr($path, $length);
        }
    }
}