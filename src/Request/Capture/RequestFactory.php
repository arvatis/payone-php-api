<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Request\Authorization\GenericRequestFactory;
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

        return new Capture(
            $genericRequest,
            $referenceId,
            $context['capturemode']
        );
    }
}
