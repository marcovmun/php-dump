<?php
/**
 * User: marco
 * Date: 16-Dec-16
 * Time: 22:03 PM
 */

namespace marcovmun\phpdump;

use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Dumper\HtmlDumper as DefaultHtmlDumper;
use Symfony\Component\Yaml\Yaml;

/**
 * Class HtmlDumper
 * @package marcovmun\phpdump
 */
class HtmlDumper extends DefaultHtmlDumper
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    protected $defaultDumpPrefix = '<pre class=sf-dump id=%s data-indent-pad=\"%s\">';

    /**
     * @var string|null
     */
    protected $dumpPrefix = null;

    /** @var HtmlDumper */
    private static $instance;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new HtmlDumper();
        }

        return self::$instance;
    }

    /**
     * HtmlDumper constructor.
     *
     * @param callable|resource|string $output
     * @param null                     $charset
     * @param int                      $flags
     */
    public function __construct($output = null, $charset = null, $flags = 0)
    {
        $this->config = Yaml::parse(file_get_contents(ROOT . 'config.yml'));
        parent::__construct($output, $charset, $flags);
    }

    public function dump(Data $data, $output = null, array $extraDisplayOptions = [])
    {
        $this->prependFileLocation();

        return parent::dump($data, $output, $extraDisplayOptions);
    }

    private function prependFileLocation()
    {
        $dump_location = debug_backtrace(false, 6)[5];
        $file = $dump_location['file'];
        $line_number = $dump_location['line'];
        $file = $this->mapFilePaths($file);
        $this->dumpPrefix = $this->defaultDumpPrefix . '<h4 class="sf-dump-h4">' .
            '<a href="openfile://open?file=' . $file . '&line=' . $line_number . '">' . $file . ':' . $line_number . '</a></h4>';

        $this->styles['h4'] = 'color: white; margin-top: 4px; margin-bottom: 4px;';
        $this->styles['h4:hover'] = 'color: red; margin-top: 4px; margin-bottom: 4px;';
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function mapFilePaths(string $path): string
    {
        if (!isset($this->config['pathmapping']) || !is_array($this->config['pathmapping'])) {
            return $path;
        }
        foreach ((array)$this->config['pathmapping'] as $mapping) {
            $remote = $mapping['remote'];
            $host = $mapping['host'];
            $length = strlen($remote);

            if (substr($path, 0, $length) === $remote) {
                return $host . substr($path, $length);
            }
        }

        return $path;
    }
}
