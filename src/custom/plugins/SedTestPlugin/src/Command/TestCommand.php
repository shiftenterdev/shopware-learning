<?php
declare(strict_types=1);

namespace SedTestPlugin\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{

    // Command name
    protected static $defaultName = 'sed-commands:test';

    // Provides a description, printed out in bin/console
    protected function configure(): void
    {
        $this->setDescription('Does something very special.');
    }

    // Actual code executed in the command
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hi, It works!');
        // Exit code 0 for success
        return 0;
    }

}
