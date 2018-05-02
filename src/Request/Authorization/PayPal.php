<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\RedirectUrls;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

/**
 * Class PayPal
 */
class PayPal extends AuthorizationAbstract implements RequestDataContract
{
    const WALLET_TYPE = 'PPE';
    /**
     * @var string
     */
    private $wallettype = self::WALLET_TYPE;
    /**
     * @var RedirectUrls
     */
    private $urls;

    /**
     * PayPal constructor.
     *
     * @param Config $config
     * @param $orderId
     * @param int $amount
     * @param $currency
     * @param Customer $customer
     * @param SystemInfo $info
     * @param RedirectUrls $urls
     */
    public function __construct(
        Config $config,
        $orderId,
        int $amount,
        $currency,
        Customer $customer,
        SystemInfo $info,
        RedirectUrls $urls
    ) {
        parent::__construct(
            $config,
            $customer,
            Types::AUTHORIZATION,
            ClearingTypes::WALLET,
            $info,
            $orderId,
            $amount,
            $currency
        );
        $this->urls = $urls;
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
}
