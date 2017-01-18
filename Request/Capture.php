<?php


namespace Payone\Request;


class Capture
{
    private $request;
    private $txid;
    private $amount;
    private $currency;
    private $capturemode;
    /**
     * @var Config
     */
    private $config;

    /**
     * Capture constructor.
     * @param Config $config
     * @param string $request
     * @param string $txid
     * @param string $amount
     * @param string $currency
     * @param string $capturemode
     */
    public function __construct(Config $config, $request, $txid, $amount, $currency, $capturemode)
    {
        $this->config = $config;
        $this->request = $request;
        $this->txid = $txid;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->capturemode = $capturemode;
    }

    public function toArray()
    {
        return [
            'request' => $this->request,
            'txid' => $this->txid,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'capturemode' => $this->capturemode,
        ];

    }
}