<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Request\GenericRequestAbstract;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

class Capture extends GenericRequestAbstract implements RequestDataContract, \JsonSerializable
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
    public function __construct(Config $config, $txid, $amount, $currency, $capturemode, $sequencenumber = null)
    {
        parent::__construct(
            $config,
            Types::CAPTURE,
            $amount,
            $currency,
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
