<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\AuthorizationAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\RedirectUrls;
use ArvPayoneApi\Request\Parts\ShippingAddress;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class Paydirect
 */
class Paydirect extends AuthorizationAbstract implements RequestDataContract
{
    const WALLET_TYPE = 'PDT';
    /**
     * @var string
     */
    private $wallettype = self::WALLET_TYPE;
    /**
     * @var RedirectUrls
     */
    private $urls;
    /**
     * @var ShippingAddress
     */
    private $shippingAddress;

    /**
     * Paydirect constructor.
     *
     * @param Config $config
     * @param string $orderId
     * @param int $amount
     * @param string $currency
     * @param Customer $customer
     * @param SystemInfo $info
     * @param RedirectUrls $urls
     * @param ShippingAddress $shippingAddress
     */
    public function __construct(
        Config $config, $orderId,
        int $amount,
        $currency,
        Customer $customer,
        SystemInfo $info,
        RedirectUrls $urls,
        ShippingAddress $shippingAddress
    ) {
        parent::__construct(
            $config,
            $customer,
            Types::PREAUTHORIZATION,
            ClearingTypes::WALLET,
            $info,
            $orderId,
            $amount,
            $currency
        );
        $this->urls = $urls;
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * Getter for Urls
     * @return RedirectUrls
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Getter for Wallettype
     *
     * @return string
     */
    public function getWallettype()
    {
        return $this->wallettype;
    }

    /**
     * Getter for ShippingAddress
     * @return ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

}
