<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class PrePayment
 */
class PrePayment extends AuthorizationAbstract implements RequestDataContract
{
    /**
     * @param Config $config
     * @param $orderId
     * @param int $amount Total amount (in smallest currency unit! e.g. cent)
     * @param $currency
     */
    public function __construct(Config $config, $orderId, $amount, $currency, Customer $customer, SystemInfo $info)
    {
        parent::__construct(
            $config,
            $customer,
            Types::AUTHORIZATION,
            ClearingTypes::VOR,
            $info,
            $orderId,
            (int) $amount,
            $currency
        );
    }
}
