<?php

namespace Payone\Request\Authorization;

use Payone\Request\AuthorizationGeneric;
use Payone\Request\ClearingTypes;
use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;
use Payone\Request\RequestDataContract;
use Payone\Request\Types;

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
            Types::AUTHORIZATION,
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
