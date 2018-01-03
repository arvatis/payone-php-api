<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestAbstract;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

class Capture extends RequestAbstract implements RequestDataContract
{
    private $txid;
    private $capturemode;

    /**
     * Capture constructor.
     *
     * @param Config $config
     * @param string $txid
     * @param string $amount
     * @param string $currency
     * @param string $capturemode
     */
    public function __construct(
        Config $config,
        $txid,
        $amount,
        $currency,
        $capturemode,
        SystemInfo $info,
        $sequencenumber = null
    ) {
        parent::__construct(
            $config,
            Types::CAPTURE,
            $amount,
            $currency,
            $info,
            $sequencenumber
        );
        $this->txid = $txid;
        $this->capturemode = $capturemode;
    }

    /**
     * Getter for Txid
     *
     * @return string
     */
    public function getTxid()
    {
        return $this->txid;
    }

    /**
     * Getter for Capturemode
     *
     * @return string
     */
    public function getCapturemode()
    {
        return $this->capturemode;
    }
}
