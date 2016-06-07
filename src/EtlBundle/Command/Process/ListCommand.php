<?php

namespace EtlBundle\Command\Process;

use EtlBundle\Container\ProcessLister;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('php-etl:process:list')
            ->setDescription('List available processes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $list = new ProcessLister();
        $list->getProcesses();
        return 0;
    }
}