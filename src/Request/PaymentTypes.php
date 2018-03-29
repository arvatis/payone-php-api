<?php

namespace ArvPayoneApi\Request;

/**
 * Class PaymentTypes
 */
class PaymentTypes
{
    const PAYONE_INVOICE = 'Invoice';
    const PAYONE_PRE_PAYMENT = 'PrePayment';
    const PAYONE_CASH_ON_DELIVERY = 'CashOnDelivery';
    const PAYONE_SOFORT = 'Sofort';
    const PAYONE_CREDIT_CARD = 'CreditCard';
    const PAYONE_DIRECT_DEBIT = 'DirectDebit';
    const PAYONE_PAY_PAL = 'PayPal';

    /**
     * @return mixed
     */
    public static function getPaymentTypes()
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}
