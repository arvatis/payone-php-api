<?php

namespace ArvPayoneApi\Request\Capture;

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
     * @param string|null $referenceId
     *
     * @return \ArvPayoneApi\Request\Capture\Capture|\ArvPayoneApi\Request\RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
    {
        $genericRequest = GenericRequestFactory::create(Types::CAPTURE, $data);
        $context = $data['context'];

        $cart = null;
        if ($paymentMethod == PaymentTypes::PAYONE_INVOICE_SECURE) {
            $cart = CartFactory::create($data);
        }

        return new Capture(
            $genericRequest,
            $referenceId,
            $context['capturemode'],
            $context['settleaccount'] ?? SettleAccountModes::AUTO,
            $cart
        );
    }
}
