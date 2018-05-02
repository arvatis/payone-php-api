<?php

namespace ArvPayoneApi\Request\Managemandate;

use ArvPayoneApi\Request\ClearingTypes;
use ArvPayoneApi\Request\Parts\BankAccount;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\Types;

class ManageMandate implements RequestDataContract
{
    private $clearingtype = ClearingTypes::DEBIT_PAYMENT;
    private $mandateIdentification;
    private $currency;
    private $bankAccount;
    /**
     * @var Customer
     */
    private $customer;
    private $request = Types::MANAGEMANDATE;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var SystemInfo
     */
    private $info;

    /**
     * ManageMandate constructor.
     *
     * @param Config $config
     * @param string $currency
     * @param Customer $customer
     * @param SystemInfo $info
     * @param BankAccount $bankAccount
     * @param string $mandateIdentification
     */
    public function __construct(
        Config $config,
        $currency,
        Customer $customer,
        SystemInfo $info,
        BankAccount $bankAccount,
        $mandateIdentification = ''
    ) {
        $this->config = $config;
        $this->currency = $currency;
        $this->customer = $customer;
        $this->info = $info;
        $this->bankAccount = $bankAccount;
        $this->mandateIdentification = $mandateIdentification;
    }

    /**
     * Getter for Clearingtype
     *
     * @return string
     */
    public function getClearingtype()
    {
        return $this->clearingtype;
    }

    /**
     * Getter for MandateIdentification
     *
     * @return mixed
     */
    public function getMandateIdentification()
    {
        return $this->mandateIdentification;
    }

    /**
     * Getter for Currency
     *
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Getter for Request
     *
     * @return string
     */
    public function getRequest()
    {
        return $this->request;
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

    /**
     * Getter for Customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Getter for Config
     *
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Getter for Info
     *
     * @return SystemInfo
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Getter for Sequencenumber
     */
    public function getSequencenumber()
    {
        return null;
    }

    /**
     * Getter for Amount
     *
     * @return int
     */
    public function getAmount()
    {
        return null;
    }
}
