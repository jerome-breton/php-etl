<?php

namespace EtlBundle\Container;

use EtlBundle\Process\ProcessAbstract;

class ProcessLister
{
    private $processes;

    public function __construct()
    {
        $this->processes = array();
    }

    public function addProcess(ProcessAbstract $process)
    {
        $this->processes[] = $process;
    }

    public function getProcesses()
    {
        print_r($this->processes);
    }
}