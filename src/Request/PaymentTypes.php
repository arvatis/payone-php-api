<?php

namespace ArvPayoneApi\Request;

/**
 * Class PaymentTypes
 */
class PaymentTypes
{
    const PAYONE_INVOICE = 'Invoice';
    const PAYONE_PRE_PAYMENT= 'PrePayment';
    const PAYONE_CASH_ON_DELIVERY = 'CashOnDelivery';
    const PAYONE_SOFORT = 'Sofort';

    /**
     * @return mixed
     */
    public static function getPaymentTypes()
    {
        $oClass = new \ReflectionClass(__CLASS__);

        return $oClass->getConstants();
    }
}
