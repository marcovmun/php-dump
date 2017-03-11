<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17-Dec-16
 * Time: 19:11 PM
 */

namespace marcovmun\openfile\console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

class Open_file extends Application
{
    /**
     * Class Constructor.
     *
     * Initialize the Open file command
     *
     * @param string $version The Application Version
     */
    public function __construct($version = '0.0.1')
    {
        parent::__construct('Open file by Marco van Munster', $version);

        $config = Yaml::parse(file_get_contents(ROOT . 'config.yml'));
        $this->addCommands(array(
            new commands\Open_command($config),
        ));
    }



    /**
     * Runs the current application.
     *
     * @param InputInterface $input An Input instance
     * @param OutputInterface $output An Output instance
     * @return integer 0 if everything went fine, or an error code
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getFirstArgument();
        if (($parsed_paramas = parse_url($url)) && isset($parsed_paramas['scheme'])) {
            $params = [
                'openfile',
                $parsed_paramas['host'],
            ];
            parse_str($parsed_paramas['query'], $query_parts);
            foreach ($query_parts as $name => $value) {
                $params[] = '--' . $name;
                $params[] = $value;
            }
            $input = new ArgvInput($params);
        }

        return parent::doRun($input, $output);
    }
}
