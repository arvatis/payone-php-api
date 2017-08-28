<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;

/**
 * Class GenericRequest
 */
class GenericRequest extends RequestDataAbstract implements RequestDataContract, \JsonSerializable
{
    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $clearingtype;

    /**
     * @var string
     */
    private $reference;

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

    /** @var Customer */
    private $customer;

    /**
     * @param Config $config
     * @param Customer $customer
     * @param $clearingtype
     * @param $reference
     * @param $amount
     * @param $currency
     * @internal param $request
     */
    public function __construct(
        Config $config,
        Customer $customer,
        $request,
        $clearingtype,
        $reference,
        $amount,
        $currency
    ) {
        $this->config = $config;
        $this->customer = $customer;
        $this->request = $request;
        $this->clearingtype = $clearingtype;
        $this->reference = $reference;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Getter for Reference
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Getter for Amount
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * Getter for Currency
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Getter for Config
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * Getter for Customer
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getClearingtype(): string
    {
        return $this->clearingtype;
    }
}
