<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;

/**
 * Class GenericRequest
 */
class GenericRequest implements RequestDataContract
{
    /**
     * @var string
     */
    protected $request;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /** @var Config */
    private $config;

    /** @var string|null */
    private $sequencenumber;

    /** @var string|null */
    private $param;
    /**
     * @var SystemInfo
     */
    private $info;

    /**
     * GenericRequest constructor.
     *
     * @param Config $config
     * @param string $request
     * @param int $amount
     * @param string $currency
     * @param SystemInfo $info
     * @param string|null $sequencenumber
     * @param string|null $param
     */
    public function __construct(
        Config $config,
        $request,
        int $amount,
        $currency,
        SystemInfo $info,
        $sequencenumber = null,
        $param = null
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->sequencenumber = $sequencenumber;
        $this->info = $info;
        $this->param = $param;
    }

    /**
     * Getter for Sequencenumber
     */
    public function getSequencenumber()
    {
        return $this->sequencenumber;
    }

    /**
     * Getter for Amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Getter for Currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Getter for Config
     *
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Getter for Info
     *
     * @return SystemInfo
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string|null
     */
    public function getParam()
    {
        return $this->param;
    }
}
