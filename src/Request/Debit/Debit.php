<?php

namespace ArvPayoneApi\Request\Debit;

use ArvPayoneApi\Request\GenericRequestAbstract;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

class Debit extends GenericRequestAbstract implements RequestDataContract, \JsonSerializable
{
    private $txid;

    /**
     * Capture constructor.
     *
     * @param Config $config
     * @param string $txid
     * @param string $amount
     * @param string $currency
     * @param string $capturemode
     */
    public function __construct(Config $config, $txid, $amount, $currency, $sequencenumber = null)
    {
        parent::__construct(
            $config,
            Types::DEBIT,
            -$amount,
            $currency,
            $sequencenumber
        );
        $this->txid = $txid;
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
}
