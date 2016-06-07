<?php

namespace EtlBundle\Process;

use Psr\Log\LoggerInterface;

class ProcessAbstract
{
    const RETURN_SUCCESS = 0;
    const RETURN_NOEXTRACT = 1;
    const RETURN_NOTRANSFORM = 2;
    const RETURN_NOLOAD = 3;
    const RETURN_NOTENOUGHLOAD = 4;

    private $_extracted = null;
    private $_transformed = null;
    private $_loaded = null;
    private $_logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    final public function run()
    {
        $this->_logger->info('Begining extraction');
        $this->_extracted = $this->extract();
        $this->_logger->notice('Finished extraction', array('elements' => $this->_extracted));
        if ($error = $this->validateExtraction()) {
            return $error;
        }

        $this->_logger->info('Begining transformation');
        $this->_transformed = $this->transform();
        $this->_logger->notice('Finished transformation', array('elements' => $this->_transformed));
        if ($error = $this->validateTransformation()) {
            return $error;
        }

        $this->_logger->info('Begining loading');
        $this->_loaded = $this->load();
        $this->_logger->notice('Finished loading', array('elements' => $this->_loaded));
        if ($error = $this->validateLoading()) {
            return $error;
        }

        return self::RETURN_SUCCESS;
    }

    protected function extract()
    {
        return 0;
    }

    protected function validateExtraction()
    {
        if (!$this->_extracted) {
            $this->_logger->error('No element extracted.');
            return self::RETURN_NOEXTRACT;
        }

        return self::RETURN_SUCCESS;
    }

    protected function transform()
    {
        return 0;
    }

    protected function validateTransformation()
    {
        if (!$this->_transformed) {
            $this->_logger->error('No element left after transformation.');
            return self::RETURN_NOTRANSFORM;
        }

        return self::RETURN_SUCCESS;
    }

    protected function load()
    {
        return 0;
    }

    protected function validateLoading()
    {
        if (!$this->_loaded) {
            $this->_logger->error('No element loaded.');
            return self::RETURN_NOLOAD;
        }
        if ($this->_loaded != $this->_transformed) {
            $this->_logger->error('Elements lost during loading', [
                'loaded' => $this->_loaded,
                'transformed' => $this->_transformed,
                'lost' => $this->_transformed - $this->_loaded,
            ]);
            return self::RETURN_NOTENOUGHLOAD;
        }

        return self::RETURN_SUCCESS;
    }
}