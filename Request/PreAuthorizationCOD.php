<?php


namespace Payone\Request;

use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;

/**
 * Class PreAuthorizationCOD
 */
class PreAuthorizationCOD implements RequestDataContract
{
    private $shippingprovider;
    /**
     * @var PreAuthorizationGeneric
     */
    private $request;

    /**
     * @var Config
     */
    private $config;

    /** @var Customer */
    private $customer;

    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     * @param $shippingprovider
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer,$shippingprovider)
    {
        $this->config = $config;
        $this->customer = $customer;
        $this->request = new PreAuthorizationGeneric(
            Types::PREAUTHORIZATION,
            ClearingTypes::COD,
            $orderId,
            (int)$amount,
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
        return array_merge($this->config->toArray(), $this->customer->toArray(), $data);
    }
}