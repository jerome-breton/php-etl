<?php
/**
 * Created by PhpStorm.
 * User: jerome
 * Date: 06/06/16
 * Time: 22:50
 */

namespace SampleEtlBundle\Process;

use EtlBundle\Process\ProcessAbstract;

class SampleProcess extends ProcessAbstract
{
    protected $_name = 'Sample Process';

    public function extract()
    {
        return 10;
    }

    public function transform()
    {
        return 10;
    }

    public function load()
    {
        return 10;
    }
}