<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\AuthorizationAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class CashOnDelivery
 */
class CashOnDelivery extends AuthorizationAbstract implements RequestDataContract
{
    private $shippingprovider;

    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     * @param $shippingprovider
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer, $shippingprovider, SystemInfo $info)
    {
        parent::__construct(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::COD,
            $info,
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
