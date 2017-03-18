<?php
/**
 * User: marco
 * Date: 20-Dec-16
 * Time: 22:11 PM
 */

namespace marcovmun\phpdump\config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 * @package marcovmun\phpdump\config
 */
class Config
{
    /**
     * @var string[]
     */
    private $config;

    /**
     * @var PathMapping[]
     */
    private $pathMappings = [];

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->config = Yaml::parse(file_get_contents(ROOT . 'config.yml'));

        if (isset($this->config['pathmapping']) && is_array($this->config['pathmapping'])) {
            foreach ($this->config['pathmapping'] as $mapping) {
                if (isset($mapping['host']) && isset($mapping['remote'])) {
                    $path_mappings[] = new PathMapping($mapping['remote'], isset($mapping['host']));
                }
            }
        }
    }

    /**
     * @param string $path
     *
     * @return string
     */
    public function mapFilePaths(string $path): string
    {
        foreach ($this->pathMappings as $mapping) {
            $mapping->hostifyPath($path);
        }

        return $path;
    }
}
