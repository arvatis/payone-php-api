<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;
use ArvPayoneApi\Request\Parts\RedirectUrls;
use ArvPayoneApi\Request\Parts\ShippingAddress;

/**
 * Class Paydirect
 */
class Paydirect extends AuthorizationRequestAbstract
{
    const WALLET_TYPE = 'PDT';

    protected $clearingtype = ClearingTypes::WALLET;
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
     * @param GenericAuthorizationRequest $authorizationRequest
     * @param string $clearingtype
     * @param RedirectUrls $urls
     * @param ShippingAddress $shippingAddress
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest,
        RedirectUrls $urls,
        ShippingAddress $shippingAddress
    ) {
        $this->authorizationRequest = $authorizationRequest;
        $this->urls = $urls;
        $this->shippingAddress = $shippingAddress;
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
     *
     * @return ShippingAddress
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }
}
