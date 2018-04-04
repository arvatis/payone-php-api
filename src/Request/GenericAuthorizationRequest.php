<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Customer;

/**
 * Class GenericAuthorization
 */
class GenericAuthorizationRequest extends AuthorizationRequestAbstract implements AuthorizationRequestContract
{
    /** @var Customer */
    protected $customer;

    /** @var string|null */
    protected $reference;
    /**
     * @var GenericRequest
     */
    protected $genericRequest;

    /**
     * @param GenericRequest $genericRequest
     * @param string $reference
     * @param int $amount
     * @param string $currency
     *
     * @internal param $request
     */
    public function __construct(
        GenericRequest $genericRequest,
        string $reference,
        Customer $customer
    ) {
        $this->customer = $customer;
        $this->reference = $reference;
        $this->genericRequest = $genericRequest;
    }

    /**
     * Getter for Reference
     */
    public function getReference()
    {
        return $this->reference;
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

    /**
     * Getter for GenericRequestrequest
     *
     * @return GenericRequest
     */
    public function getGenericRequest()
    {
        return $this->genericRequest;
    }
}
