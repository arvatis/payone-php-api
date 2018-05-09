<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;
use ArvPayoneApi\Request\Parts\Cart;

/**
 * Class InvoiceSecure
 */
class InvoiceSecure extends AuthorizationRequestAbstract
{
    const PAYONE_INVOICE_CLEARING_TYPE = 'POV';

    protected $clearingtype = ClearingTypes::REC;

    protected $subclearingtype = self::PAYONE_INVOICE_CLEARING_TYPE;
    /**
     * @var Cart
     */
    private $cart;

    /**
     * Invoice constructor.
     *
     * @param GenericAuthorizationRequest $authorizationRequest
     * @param Cart $cart
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest,
        Cart $cart
    ) {
        $this->authorizationRequest = $authorizationRequest;
        $this->cart = $cart;
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

    /**
     * Getter for Cart
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}
