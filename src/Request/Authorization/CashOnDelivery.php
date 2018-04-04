<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;

/**
 * Class CashOnDelivery
 */
class CashOnDelivery extends AuthorizationRequestAbstract
{
    /**
     * @var string
     */
    protected $clearingtype = ClearingTypes::COD;

    /**
     * @var string
     */
    private $shippingprovider;

    /**
     * Invoice constructor.
     *
     * @param GenericAuthorizationRequest $authorizationRequest
     * @param $shippingprovider
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest,
        $shippingprovider
    ) {
        $this->authorizationRequest = $authorizationRequest;
        $this->shippingprovider = $shippingprovider;
    }

    /**
     * Getter for Shippingprovider
     *
     * @return mixed
     */
    public function getShippingprovider()
    {
        return $this->shippingprovider;
    }
}
