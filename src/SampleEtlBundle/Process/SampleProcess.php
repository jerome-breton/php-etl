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
    private $sampleElements = [];
    private $sampleSubElements = [];

    public function extract()
    {
        $c = rand(10, 100);
        for ($i = 0; $i <= $c; $i++) {
            $e = new \stdClass();
            $e->id = $i;
            $e->data = rand(1, 1000);
            $this->sampleElements[] = $e;
        }
        return count($this->sampleElements);
    }

    public function transform()
    {
        $j = 0;
        foreach ($this->sampleElements as $e) {
            $c = rand(1, 10);
            for ($i = 0; $i <= $c; $i++) {
                $sub = new \stdClass();
                $sub->id = $j++;
                $sub->parent = $e->id;
                $sub->data = $e->data . '-' . rand(1, 1000);
                $this->sampleSubElements[] = $sub;
            }
        }
        return count($this->sampleElements) + count($this->sampleSubElements);
    }

    public function load()
    {
        $i = 0;
        $fp = fopen('sampleOutput.csv', 'w');
        fputcsv($fp, ['id', 'data']);

        foreach ($this->sampleElements as $e) {
            $len = fputcsv($fp, [$e->id, $e->data]);
            if ($len !== false) {
                $i++;
            }
        }

        $fp = fopen('sampleSubOutput.csv', 'w');
        fputcsv($fp, ['id', 'parent', 'data']);

        foreach ($this->sampleSubElements as $e) {
            $len = fputcsv($fp, [$e->id, $e->parent, $e->data]);
            if ($len !== false) {
                $i++;
            }
        }

        return $i;
    }
}