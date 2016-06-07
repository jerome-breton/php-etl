<?php

namespace EtlBundle\Command\Process;

use EtlBundle\Container\ProcessLister;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
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
        /** @var ProcessLister $list */
        $list = $this->getContainer()->get('jbreton_php_etl.process_lister');
        $process = $list->getProcess($input->getArgument('processName'));

        return $process->run();
    }
}