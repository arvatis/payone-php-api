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
     * @return array
     */
    public static function getRequestData($paymentMethod, $request, $returnStaticData = false)
    {
        if (!in_array($paymentMethod, self::$allowedPayments)) {
            throw new \InvalidArgumentException('Unknown payment method "' . $paymentMethod . '"');
        }
        if (!in_array($request, Types::getRequestTypes())) {
            throw new \InvalidArgumentException('Unknown request type "' . $request . '""');
        }

        $className = 'Tests\Payone\Mock\Request\\' . $paymentMethod . '\\' . ucfirst($request) . 'Data';
        /** @var RequestContract $mockData */
        $mockData = new  $className();

        if ($returnStaticData) {
            $data = array_merge(
                $mockData->getConfig(),
                $mockData->getPersonalDataStatic(),
                $mockData->getRequestData()
            );
            $data['reference'] = 'order-123657';
            return $data;
        }
        return array_merge($mockData->getConfig(), $mockData->getPersonalData(), $mockData->getRequestData());
    }

}