<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;

/**
 * Class Invoice
 */
class Invoice extends AuthorizationRequestAbstract
{
    protected $clearingtype = ClearingTypes::REC;

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
}
