<?php

namespace ArvPayoneApi\Mocks;

use ArvPayoneApi\Mocks\Request\RequestContract;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\Types;

class RequestMockFactory
{

    /**
     * @param string $paymentMethod
     * @param string $request PreCheck
     * @param bool $returnStaticData
     *
     * @return array
     */
    public static function getRequestData($paymentMethod, $request, $returnStaticData = false)
    {
        self::validate($paymentMethod, $request);

        $className = 'ArvPayoneApi\Mocks\Request\\' . $paymentMethod . '\\' . ucfirst($request) . 'Data';
        /** @var RequestContract $mockData */
        $mockData = new  $className();

        $data = array_merge(
            $mockData->getConfig(),
            $mockData->getPersonalDataStatic(),
            $mockData->getRequestData(),
            $mockData->getOrder()
        );

        if ($request == 'capture') {
            unset($data['reference']);
        }
        if ($returnStaticData) {
            $data = array_merge($data, $mockData->getPersonalDataStatic());
            asort($data);
            return $data;
        }

        $data = array_merge($data, $mockData->getRequestData());
        asort($data);
        return $data;
    }

    /**
     * @param $paymentMethod
     * @param $request
     */
    private static function validate($paymentMethod, $request)
    {
        if (!in_array($paymentMethod, PaymentTypes::getPaymentTypes())) {
            throw new \InvalidArgumentException('Unknown payment method "' . $paymentMethod . '"');
        }
        if (!in_array($request, Types::getRequestTypes())) {
            throw new \InvalidArgumentException('Unknown request type "' . $request . '""');
        }
    }
}
