<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 07/06/16
 * Time: 00:15
 */

namespace EtlBundle\Console;

class OutputFormatter extends \Symfony\Component\Console\Formatter\OutputFormatter
{
    private $process = '';

    public function setProcessName($process)
    {
        $this->process = sprintf('[%s]', $process);
        return $this;
    }

    public function format($message)
    {
        $d = new \DateTime();
        return parent::format(sprintf("[%s]%s%s",
            $d->format(\DateTime::W3C),
            $this->process, $message));
    }
}