<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\SystemInfo;

/**
 * Class GenericAuthorization
 */
abstract class AuthorizationAbstract extends RequestAbstract implements RequestDataContract
{
    /**
     * @var string
     */
    private $clearingtype;

    /** @var Customer */
    private $customer;

    /** @var string|null */
    private $reference;

    /**
     * @var AuthorizationAbstract
     */
    protected $authorization;
    /**
     * @param Config $config
     * @param Customer $customer
     * @param string $clearingtype
     * @param string $reference
     * @param int $amount
     * @param string $currency
     *
     * @internal param $request
     */
    public function __construct(
        Config $config,
        Customer $customer,
        $request,
        $clearingtype,
        SystemInfo $info,
        $reference,
        $amount,
        $currency
    ) {
        parent::__construct(
            $config,
            $request,
            $amount,
            $currency,
            $info
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
    public function getClearingtype()
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
