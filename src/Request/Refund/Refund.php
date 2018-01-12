<?php

namespace ArvPayoneApi\Request\Refund;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestAbstract;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

class Refund extends RequestAbstract implements RequestDataContract
{
    private $txid;

    /**
     * Refund constructor.
     *
     * @param Config $config
     * @param $txid
     * @param $amount
     * @param $currency
     * @param SystemInfo $info
     * @param null $sequencenumber
     */
    public function __construct(Config $config, $txid, $amount, $currency, SystemInfo $info, $sequencenumber = null)
    {
        parent::__construct(
            $config,
            Types::REFUND,
            -$amount,
            $currency,
            $info,
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
