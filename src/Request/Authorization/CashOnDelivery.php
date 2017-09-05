<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationAbstract;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class CashOnDelivery
 */
class CashOnDelivery extends GenericAuthorizationAbstract implements RequestDataContract, \JsonSerializable
{
    private $shippingprovider;

    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     * @param $shippingprovider
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer, $shippingprovider)
    {
        parent::__construct(
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
     * Getter for Shippingprovider
     *
     * @return mixed
     */
    public function getShippingprovider()
    {
        return $this->shippingprovider;
    }
}
