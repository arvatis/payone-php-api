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
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     * @param $shippingprovider
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer, $shippingprovider)
    {
        $this->request = new PreAuthorizationGeneric(
            $config,
            $customer,
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
        return $data;
    }
}