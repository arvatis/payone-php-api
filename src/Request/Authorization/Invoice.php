<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationAbstract;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class Invoice
 */
class Invoice extends GenericAuthorizationAbstract implements RequestDataContract, \JsonSerializable
{
    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer)
    {
        parent::__construct(
            $config,
            $customer,
            Types::AUTHORIZATION,
            ClearingTypes::REC,
            $orderId,
            (int) $amount,
            $currency
        );
    }
}
