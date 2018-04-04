<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;

/**
 * Class Invoice
 */
class InvoiceSecure extends AuthorizationRequestAbstract
{
    protected $clearingtype = ClearingTypes::REC;

    protected $subclearingtype = ClearingTypes::POV;

    /**
     * Invoice constructor.
     *
     * @param GenericAuthorizationRequest $authorizationRequest
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest
    ) {
        $this->authorizationRequest = $authorizationRequest;
    }

    /**
     * Getter for Subclearingtype
     * @return string
     */
    public function getSubclearingtype()
    {
        return $this->subclearingtype;
    }
}
