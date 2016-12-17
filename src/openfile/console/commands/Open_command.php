<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 17-Dec-16
 * Time: 20:32 PM
 */

namespace marcovmun\openfile\console\commands;

use marcovmun\openfile\editors\Editor_interface;
use marcovmun\openfile\editors\Phpstorm_editor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Open_command extends Command
{
    /** @var string */
    protected $file;

    /** @var string */
    protected $line;

    /** @var string[] */
    protected $config;

    /** @var Editor_interface */
    protected $editor;

    /**
     * @return string
     */
    public function get_file() : string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function get_line(): string
    {
        return $this->line;
    }

    /**
     * @return \string[]
     */
    public function get_config(): array
    {
        return $this->config;
    }

    /**
     * @param string $file
     */
    protected function set_file(string $file)
    {
        if ($file === null) {
            throw new \InvalidArgumentException('The file Option is required');
        }
        $this->file = $file;
    }

    /**
     * @param string $line
     */
    protected function set_line(string $line)
    {
        $this->line = $line;
    }

    /**
     * @param \string[] $config
     */
    protected function set_config(array $config)
    {
        $this->config = $config;
    }

    public function __construct(array $config)
    {
        $this->set_config($config);
        parent::__construct(null);
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('open')
            ->setDescription('Initialize the application for Phinx')
            ->addOption('file', 'f', InputOption::VALUE_REQUIRED, 'Which file do you want to open?')
            ->addOption('line', 'l', InputOption::VALUE_REQUIRED, 'Which line number should we go?')
            ->addOption('editor', 'e', InputOption::VALUE_REQUIRED, 'In which editor should the file be opened.' .
    'If not set the editor is used that is defined in config.yml')
            ->setHelp(sprintf(
                '%sOpen file%s',
                PHP_EOL,
                PHP_EOL
            ));

    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // get the migration path from the config
        $this->set_file($input->getOption('file'));
        $this->line = $input->getOption('line');
        parent::initialize($input, $output);
    }

    /**
     * Initializes the application.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        switch ($this->get_config()['editor']) {
            case 'phpstorm':
                $editor = new Phpstorm_editor();
                break;
            default:
                throw new \InvalidArgumentException('Editor no valid');
        }
        $editor->set_file($this->file);
        $editor->set_line_number($this->get_line());
        $editor->set_application_executable($this->config['executable']);

        $editor->execute();

        $output->writeln('<info>Succes</info>');
    }


}