<?php

namespace EtlBundle\Container;

use EtlBundle\Process\ProcessAbstract;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class ProcessLister
{
    private $processes;

    public function __construct()
    {
        $this->processes = array();
    }

    public function addProcess($id, ProcessAbstract $process)
    {
        $this->processes[$id] = $process;
    }

    public function getProcesses()
    {
        return $this->processes;
    }

    public function getProcess($id)
    {
        if (!isset($this->processes[$id])) {
            throw new InvalidArgumentException('No process with the id "' . $id . '" found.');
        }
        return $this->processes[$id];
    }
}