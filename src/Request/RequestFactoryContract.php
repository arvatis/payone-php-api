<?php

namespace ArvPayoneApi\Request;

interface RequestFactoryContract
{
    /**
     * @param string $requestType
     * @param string $paymentMethod
     * @param string|bool $referenceId Reference to previous request
     * @param array $data
     *
     * @throws \Exception
     *
     * @return RequestDataContract
     */
    public static function create($paymentMethod, $referenceId = false, $data = []): RequestDataContract;


}
