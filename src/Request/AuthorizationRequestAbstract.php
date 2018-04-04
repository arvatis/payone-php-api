<?php

namespace ArvPayoneApi\Request;

/**
 * Class PrePayment
 */
abstract class AuthorizationRequestAbstract
{
    /**
     * @var string
     */
    protected $clearingtype;

    /**
     * @var GenericAuthorizationRequest
     */
    protected $authorizationRequest;

    /**
     * @return GenericAuthorizationRequest
     */
    public function getAuthorizationRequest()
    {
        return  $this->authorizationRequest;
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
}
