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

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->filesystem = new Filesystem;
        $this->verifySrc();
    }

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName($this->name)
            ->setDescription($this->description);
    }

    /**
     * Set Arguments
     *
     * @return void
     */
    protected function setArguments()
    {
        $this->addArgument('name', InputArgument::REQUIRED);
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
        if (!is_dir($this->filesystem->exists('src/main/java'))) {
            $this->filesystem->mkdir('src/main/java');
        }
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

    }
}
