<?php

namespace Payone\Request\PreAuthorization;

use Payone\Request\AuthorizationGeneric;
use Payone\Request\ClearingTypes;
use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;
use Payone\Request\RequestDataContract;
use Payone\Request\Types;

/**
 * Class Invoice
 */
class Invoice implements RequestDataContract
{
    /**
     * @var AuthorizationGeneric
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
        $this->request = new AuthorizationGeneric(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::REC,
            $orderId,
            (int) $amount,
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
