<?php

namespace ArvPayoneApi\Request;

interface RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param string|bool $referenceId Reference to previous request
     *
     * @return RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null);
}
