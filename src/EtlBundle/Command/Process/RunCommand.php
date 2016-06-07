<?php

namespace EtlBundle\Command\Process;

use EtlBundle\Console\OutputFormatter;
use SampleEtlBundle\Process\SampleProcess;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('php-etl:process:run')
            ->setDescription('Launch a process')
            ->addArgument(
                'processName',
                InputArgument::REQUIRED,
                'Name of the process to run (see "process:list" command)'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formatter = new OutputFormatter();
        $output->setFormatter($formatter);

        if ($output->getVerbosity() == ConsoleOutput::VERBOSITY_NORMAL) {
            $output->setVerbosity(ConsoleOutput::VERBOSITY_VERBOSE);
        }

        $process = new SampleProcess(new ConsoleLogger($output));
        $formatter->setProcessName($process->getName());
        return $process->run();
    }
}