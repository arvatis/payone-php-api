<?php


namespace Payone\Request;

use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;

/**
 * Class PreAuthorizationInvoice
 */
class PreAuthorizationPrePayment implements RequestDataContract
{
    /**
     * @var PreAuthorizationGeneric
     */
    private $request;

    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     */
    public function __construct(Config $config, $orderId, int $amount, $currency, Customer $customer)
    {
        $this->config = $config;
        $this->customer = $customer;
        $this->request = new PreAuthorizationGeneric(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::VOR,
            $orderId,
            (int)$amount,
            $currency
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->request->toArray();
    }
}