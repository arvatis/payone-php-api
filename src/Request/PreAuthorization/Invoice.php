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
 * Class Invoice
 */
class Invoice extends AuthorizationAbstract implements RequestDataContract
{
    /**
     * @param Config $config
     * @param string$orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param string $currency
     */
    public function __construct(Config $config, $orderId, int $amount, $currency, Customer $customer, SystemInfo $info)
    {
        parent::__construct(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::REC,
            $info,
            $orderId,
            $amount,
            $currency
        );
    }
}
