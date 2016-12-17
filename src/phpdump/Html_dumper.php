<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 16-Dec-16
 * Time: 22:03 PM
 */

namespace marcovmun\phpdump;


use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class Html_dumper extends HtmlDumper
{
    protected $dumpPrefix = '<pre class=sf-dump id=%s data-indent-pad=\"%s\">';

    /**
     * Html_dumper constructor.
     * @param callable|resource|string $output
     * @param null $charset
     * @param int $flags
     */
    public function __construct($output = null, $charset = null, $flags = 0)
    {
        parent::__construct($output, $charset, $flags);
    }

    public function dump(Data $data, $output = null, array $extraDisplayOptions = array())
    {
        $this->prepend_file_location();

        return parent::dump($data, $output, $extraDisplayOptions);
    }

    private function prepend_file_location()
    {
        $dump_location = debug_backtrace(false, 6)[5];
        $file = $dump_location['file'];
        $line_number = $dump_location['line'];
        $this->dumpPrefix .= '<h4 class="sf-dump-h4">' .
           '<a href="openfile://open?file=' . $file . '&line=' . $line_number . '">' . $file . ':' . $line_number .  '</a></h4>';

        $this->styles['h4'] = 'color: white; margin-top: 4px; margin-bottom: 4px;';
        $this->styles['h4:hover'] = 'color: red; margin-top: 4px; margin-bottom: 4px;';

    }
}
