<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericRequest;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\RequestDataAbstract;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class PrePayment
 */
class PrePayment extends RequestDataAbstract implements RequestDataContract, \JsonSerializable
{
    /**
     * @var GenericRequest
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
        $this->request = new GenericRequest(
            $config,
            $customer,
            Types::AUTHORIZATION,
            ClearingTypes::VOR,
            $orderId,
            (int) $amount,
            $currency
        );
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->request->jsonSerialize() + parent::jsonSerialize();
    }
}
