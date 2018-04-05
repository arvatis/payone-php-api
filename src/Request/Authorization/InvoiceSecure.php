<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;

/**
 * Class InvoiceSecure
 */
class InvoiceSecure extends AuthorizationRequestAbstract
{

    const PAYONE_INVOICE_CLEARING_TYPE = 'POV';

    protected $clearingtype = ClearingTypes::REC;

    protected $subclearingtype = self::PAYONE_INVOICE_CLEARING_TYPE;

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
     *
     * @return string
     */
    public function getSubclearingtype()
    {
        return $this->subclearingtype;
    }
}
