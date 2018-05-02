<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Request\Parts\Customer;

/**
 * Class GenericAuthorization
 */
interface AuthorizationRequestContract
{
    /**
     * Getter for Clearingtype
     *
     * @return string
     */
    public function getClearingtype();

    /**
     * Getter for Reference
     */
    public function getReference();

    /**
     * Getter for Customer
     *
     * @return Customer
     */
    public function getCustomer(): Customer;

    /**
     * Getter for GenericRequestrequest
     *
     * @return GenericRequest
     */
    public function getGenericRequest();

    /**
     * @return GenericAuthorizationRequest
     */
    public function getAuthorizationRequest();
}
