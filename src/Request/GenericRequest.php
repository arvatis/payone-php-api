<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\SystemInfo;

/**
 * Class GenericRequest
 */
class GenericRequest implements RequestDataContract
{

    /** @var string */
    protected $request;

    /** @var int */
    private $amount;

    /** @var string */
    private $currency;

    /** @var Config */
    private $config;

    /** @var SystemInfo */
    private $info;

    /** @var string|null */
    private $sequencenumber;

    /** @var string|null */
    private $param;

    /** @var string|null */
    private $reference;

    /** @var string|null */
    private $narrative_text;

    /** @var string|null */
    private $transaction_param;


    /**
     * GenericRequest constructor.
     * @param Config $config
     * @param $request
     * @param int $amount
     * @param $currency
     * @param SystemInfo $info
     * @param null $sequencenumber
     * @param null $param
     * @param null $reference
     * @param null $narrative_text
     * @param null $transaction_param
     */
    public function __construct(
        Config $config,
        $request,
        int $amount,
        $currency,
        SystemInfo $info,
        $sequencenumber = null,
        $param = null,
        $reference = null,
        $narrative_text = null,
        $transaction_param = null
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->info = $info;
        $this->sequencenumber = $sequencenumber;
        $this->param = $param;
        $this->reference = $reference;
        $this->narrative_text = $narrative_text;
        $this->transaction_param = $transaction_param;
    }


    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * @return SystemInfo
     */
    public function getInfo(): SystemInfo
    {
        return $this->info;
    }

    /**
     * @return string|null
     */
    public function getSequencenumber(): ?string
    {
        return $this->sequencenumber;
    }

    /**
     * @return string|null
     */
    public function getParam(): ?string
    {
        return $this->param;
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @return string|null
     */
    public function getNarrativeText(): ?string
    {
        return $this->narrative_text;
    }

    /**
     * @return string|null
     */
    public function getTransactionParam(): ?string
    {
        return $this->transaction_param;
    }

}
