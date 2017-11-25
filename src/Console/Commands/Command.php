<?php

namespace NasrulHazim\Console\Commands;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Base Command Class
 */
class Command extends SymfonyCommand
{
    /**
     * Filesystem
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
     * Output Interface
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * Path to working directory
     * @var string
     */
    protected $src;

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->filesystem = new Filesystem;
    }

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName($this->name)
            ->addArgument('name', InputArgument::REQUIRED)
            ->setDescription($this->description);
    }

    /**
     * Clean up string
     * @param  string $value
     * @return string
     */
    protected function cleanupName(string $value): string
    {
        return preg_replace('/[^A-Za-z0-9\-]/', '', $value); // Removes special chars.
    }

    /**
     * Make sure the current project have the src/main/java directory
     * @return void
     */
    protected function verifySrc()
    {
        $this->src = getcwd() . '/src/main/java';
        if (!is_dir($this->filesystem->exists($this->src))) {
            $this->filesystem->mkdir($this->src);
        }
    }

    protected function getStub()
    {
        return dirname(__FILE__) . '/stub/' . $this->stub . '.stub';
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->verifySrc();

        $name    = $input->getArgument('name');
        $explode = explode('/', $name);
        $class   = $explode[count($explode) - 1];

        $this->filesystem->copy($this->getStub(), $this->src . '/' . $name . '.java');

        $this->info(ucfirst($this->name) . ' Successfully Created');
    }

    /**
     * Output Info Message
     * @param  string $message [description]
     * @return void
     */
    public function info(string $message)
    {
        $this->output->writeln('<info>' . $message . '</info>');
    }

    /**
     * Output Comment Message
     * @param  string $message [description]
     * @return void
     */
    public function comment(string $message)
    {
        $this->output->writeln('<comment>' . $message . '</comment>');
    }

    /**
     * Output Error Message
     * @param  string $message [description]
     * @return void
     */
    public function error(string $message)
    {
        $this->output->writeln('<error>' . $message . '</error>');
    }
}
