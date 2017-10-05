<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;

/**
 * Class GenericRequestAbstract
 */
class GenericRequestAbstract implements RequestDataContract, \JsonSerializable
{
    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /** @var Config */
    private $config;

    /** @var string */
    private $sequencenumber;

    /**
     * GenericRequestAbstract constructor.
     *
     * @param Config $config
     * @param $request
     * @param $reference
     * @param int $amount
     * @param $currency
     * @param null $sequencenumber
     */
    public function __construct(
        Config $config,
        $request,
        $amount,
        $currency,
        $sequencenumber = null
    ) {
        $this->config = $config;
        $this->request = $request;
        $this->amount = (int)$amount;
        $this->currency = $currency;
        $this->sequencenumber = $sequencenumber;
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
     * Specify data which should be serialized to JSON
     *
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $oClass = new \ReflectionClass(get_class($this));
        $result = [];
        foreach ($oClass->getMethods() as $method) {
            if ($method == 'jsonSerialize') {
                continue;
            }

            if (substr($method->name, 0, 3) != 'get') {
                continue;
            }
            $propName = strtolower(substr($method->name, 3, 1)) . substr($method->name, 4);

            $value = $method->invoke($this);
            if (is_object($value)) {
                $result += $value->jsonSerialize();
                continue;
            }
            if ($value) {
                $result[$propName] = $value;
            }
        }

        asort($result);

        return $result;
    }
}
