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
     */
    public function __construct(Config $config, $orderId, int $amount, $currency, Customer $customer)
    {
        $this->config = $config;
        $this->customer = $customer;
        $this->request = new PreAuthorizationGeneric(
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
        $data = $this->request->toArray();

        return array_merge($this->config->toArray(), $this->customer->toArray(), $data);
    }
}