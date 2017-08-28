<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\AuthorizationGeneric;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class CashOnDelivery
 */
class CashOnDelivery implements RequestDataContract
{
    private $shippingprovider;
    /**
     * @var AuthorizationGeneric
     */
    private $request;

    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     * @param $shippingprovider
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer, $shippingprovider)
    {
        $this->request = new AuthorizationGeneric(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::COD,
            $orderId,
            (int) $amount,
            $currency
        );
        $this->shippingprovider = $shippingprovider;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = $this->request->toArray();
        $data['shippingprovider'] = $this->shippingprovider;

        return $data;
    }
}
