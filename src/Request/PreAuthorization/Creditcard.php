<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\AuthorizationAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\RedirectUrls;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class Creditcard
 */
class Creditcard extends AuthorizationAbstract implements RequestDataContract
{
    /**
     * @var string
     */
    private $pseudocardpan;
    /**
     * @var RedirectUrls
     */
    private $urls;

    /**
     * Creditcard constructor.
     *
     * @param Config $config
     * @param string $orderId
     * @param int $amount
     * @param string $currency
     * @param Customer $customer
     * @param SystemInfo $info
     * @param RedirectUrls $urls
     * @param string $pseudocardPan
     */
    public function __construct(
        Config $config,
        $orderId,
        int $amount,
        $currency,
        Customer $customer,
        SystemInfo $info,
        RedirectUrls $urls,
        $pseudocardPan
    ) {
        parent::__construct(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::CREDITCARD,
            $info,
            $orderId,
            $amount,
            $currency
        );
        $this->pseudocardpan = $pseudocardPan;
        $this->urls = $urls;
    }

    /**
     * Getter for Pseudocardpan
     *
     * @return string
     */
    public function getPseudocardpan()
    {
        return $this->pseudocardpan;
    }

    /**
     * Getter for Urls
     *
     * @return RedirectUrls
     */
    public function getUrls()
    {
        return $this->urls;
    }
}
