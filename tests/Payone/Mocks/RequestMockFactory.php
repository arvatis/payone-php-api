<?php

namespace Tests\Payone\Mock;

use Payone\Request\Types;
use Tests\Payone\Mock\Request\RequestContract;

class RequestMockFactory
{
    private static $allowedPayments = [
        'Sofort',
        'PrePayment',
        'CashOnDelivery',
        'Invoice',
    ];

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

        $className = 'Tests\Payone\Mock\Request\\' . $paymentMethod . '\\' . ucfirst($request) . 'Data';
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
            return array_merge($data, $mockData->getPersonalDataStatic());
        }

        return array_merge($data, $mockData->getRequestData());
    }

    /**
     * @param $paymentMethod
     * @param $request
     */
    private static function validate($paymentMethod, $request)
    {
        if (!in_array($paymentMethod, self::$allowedPayments)) {
            throw new \InvalidArgumentException('Unknown payment method "' . $paymentMethod . '"');
        }
        if (!in_array($request, Types::getRequestTypes())) {
            throw new \InvalidArgumentException('Unknown request type "' . $request . '""');
        }
    }
}
