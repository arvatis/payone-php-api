<?php

namespace ArvPayoneApi\Request\Debit;

use ArvPayoneApi\Request\GenericRequestFactory;
use ArvPayoneApi\Request\Parts\CartFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\RequestFactoryContract;
use ArvPayoneApi\Request\Types;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param null $referenceId
     *
     * @return Debit|\ArvPayoneApi\Request\RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
    {
        $data['basket']['basketAmount'] *= -1;
        $genericRequest = GenericRequestFactory::create(Types::DEBIT, $data);
        $cart = null;
        if ($paymentMethod == PaymentTypes::PAYONE_INVOICE_SECURE) {
            $cart = CartFactory::create($data);
        }
        return new Debit($genericRequest, $referenceId, $cart);
    }
}
