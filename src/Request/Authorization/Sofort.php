<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\AuthorizationRequestAbstract;
use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\GenericAuthorizationRequest;
use ArvPayoneApi\Request\Parts\BankAccount;
use ArvPayoneApi\Request\Parts\RedirectUrls;

/**
 * Class Sofort
 */
class Sofort extends AuthorizationRequestAbstract
{
    const SOFORT_BANK_TRANSFER_TYPE = 'PNT';

    protected $onlinebanktransfertype = self::SOFORT_BANK_TRANSFER_TYPE;
    protected $clearingtype = ClearingTypes::ONLINE_BANK_TRANSFER;

    /**
     * @var RedirectUrls
     */
    private $urls;
    /**
     * @var BankAccount
     */
    private $bankAccount;

    /**
     * PayPal constructor.
     *
     * @param GenericAuthorizationRequest $authorizationRequest
     * @param RedirectUrls $urls
     * @param BankAccount $bankAccount
     */
    public function __construct(
        GenericAuthorizationRequest $authorizationRequest,
        RedirectUrls $urls,
        BankAccount $bankAccount
    ) {
        $this->authorizationRequest = $authorizationRequest;
        $this->urls = $urls;
        $this->bankAccount = $bankAccount;
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
     * Getter for Onlinebanktransfertype
     *
     * @return string
     */
    public function getOnlinebanktransfertype()
    {
        return $this->onlinebanktransfertype;
    }

    /**
     * Getter for BankAccount
     *
     * @return BankAccount
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }
}
