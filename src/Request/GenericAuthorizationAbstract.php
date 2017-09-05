<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;

/**
 * Class GenericAuthorization
 */
class GenericAuthorizationAbstract extends GenericRequestAbstract implements RequestDataContract, \JsonSerializable
{
    /**
     * @var string
     */
    private $clearingtype;

    /** @var Customer */
    private $customer;

    /** @var null */
    private $reference;

    /**
     * @param Config $config
     * @param Customer $customer
     * @param $clearingtype
     * @param $reference
     * @param $amount
     * @param $currency
     *
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
        parent::__construct(
            $config,
            $request,
            $amount,
            $currency
        );
        $this->customer = $customer;
        $this->clearingtype = $clearingtype;
        $this->reference = $reference;
    }

    /**
     * Getter for Reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Getter for Clearingtype
     *
     * @return string
     */
    public function getClearingtype(): string
    {
        return $this->clearingtype;
    }

    /**
     * Getter for Customer
     *
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }
}
