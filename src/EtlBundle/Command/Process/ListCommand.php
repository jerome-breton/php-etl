<?php

namespace EtlBundle\Command\Process;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('php-etl:process:list')
            ->setDescription('List available processes');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $list = $this->getContainer()->get('jbreton_php_etl.process_lister');
        $list->getProcesses();
        return 0;
    }
}