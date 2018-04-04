<?php

namespace ArvPayoneApi\Request\Refund;

use ArvPayoneApi\Request\Authorization\GenericRequestFactory;
use ArvPayoneApi\Request\RequestFactoryContract;
use ArvPayoneApi\Request\Types;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param null $referenceId
     *
     * @return Refund|\ArvPayoneApi\Request\RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
    {
        $genericRequest = GenericRequestFactory::create(Types::REFUND, $data);

        return new Refund($genericRequest, $referenceId);
    }
}
