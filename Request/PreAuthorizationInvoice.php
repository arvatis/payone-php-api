<?php


namespace Payone\Request;

use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;


/**
 * Class PreAuthorizationInvoice
 */
class PreAuthorizationInvoice implements RequestDataContract
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
        $this->request = new PreAuthorizationGeneric(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::REC,
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