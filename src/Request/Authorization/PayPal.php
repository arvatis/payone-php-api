<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;
use ArvPayoneApi\Request\Parts\RedirectUrls;

/**
 * Class PayPal
 */
class PayPal extends AuthorizationRequestAbstract
{
    const WALLET_TYPE = 'PPE';

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
     * PayPal constructor.
     *
     * @param GenericAuthorizationRequest $authorizationRequest
     * @param RedirectUrls $urls
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest,
        RedirectUrls $urls
    ) {
        $this->authorizationRequest = $authorizationRequest;
        $this->urls = $urls;
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
}
