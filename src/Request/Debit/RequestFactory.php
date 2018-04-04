<?php

namespace ArvPayoneApi\Request\Debit;

use ArvPayoneApi\Request\GenericRequestFactory;
use ArvPayoneApi\Request\RequestFactoryContract;
use ArvPayoneApi\Request\Types;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param null $referenceId
     * @return Debit|\ArvPayoneApi\Request\RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
    {
        $genericRequest = GenericRequestFactory::create(Types::DEBIT, $data);

        return new Debit($genericRequest, $referenceId);
    }
}
