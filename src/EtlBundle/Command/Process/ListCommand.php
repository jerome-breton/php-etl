<?php

namespace EtlBundle\Command\Process;

use EtlBundle\Container\ProcessLister;
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
        /** @var ProcessLister $list */
        $list = $this->getContainer()->get('jbreton_php_etl.process_lister');
        $codes = array_keys($list->getProcesses());

        $output->writeln('<info>You can use the following codes:</info>');
        $output->writeln($codes);
        return 0;
    }
}