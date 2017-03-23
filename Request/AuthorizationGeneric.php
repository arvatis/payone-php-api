<?php

namespace Payone\Request;

use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;

/**
 * Class AuthorizationGeneric
 */
class AuthorizationGeneric implements RequestDataContract
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
     * @param $request
     * @param $clearingtype
     * @param $reference
     * @param $amount
     * @param $currency
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
     * @return array
     */
    public function toArray()
    {
        $data = [
            'request' => $this->request, // create account receivable
            'clearingtype' => $this->clearingtype, // prepayment
            'reference' => $this->reference, // a unique reference, e.g. order number
            'amount' => $this->amount, // amount in smallest currency unit, i.e. cents
            'currency' => $this->currency,
        ];

        return array_merge($this->config->toArray(), $this->customer->toArray(), $data);
    }
}
