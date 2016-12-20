<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:11 PM
 */

namespace marcovmun\phpdump\config;


use Symfony\Component\Yaml\Yaml;

class Config
{
    /** @var string[] */
    private $config;

    /** @var Path_mapping[] */
    private $path_mappings = [];

    public function __construct()
    {
        $this->config = Yaml::parse(file_get_contents(ROOT . 'config.yml'));

        if (isset($this->config['pathmapping']) && is_array($this->config['pathmapping'])) {
            foreach ($this->config['pathmapping'] as $mapping) {
                if (isset($mapping['host']) && isset($mapping['remote'])) {
                    $path_mappings[] = new Path_mapping($mapping['remote'], isset($mapping['host']));
                }
            }
        }
    }

    public function map_file_paths(string $path)
    {
        foreach ($this->path_mappings as $mapping) {
            $mapping->hostify_path($path);
        }

        return $path;
    }
}