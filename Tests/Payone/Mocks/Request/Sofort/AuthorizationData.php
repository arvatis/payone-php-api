<?php

namespace Tests\Payone\Mock\Request\Sofort;

use Tests\Payone\Mock\Request\DataAbstract;
use Tests\Payone\Mock\Request\RequestContract;

/**
 * Class AuthorizationData
 */
class AuthorizationData extends DataAbstract implements RequestContract
{
    /**
     * @return array
     */
    public function getRequestData()
    {
        return [
            'request' => 'authorization',
            'clearingtype' => 'sb',             // sb for Online Bank Transfer
            'onlinebanktransfertype' => 'PNT',  // PNT for Sofort
            'bankcountry' => 'DE',
            //"bankaccount" => "12345678",
            //"bankcode" => "88888888",
            'iban' => 'DE85123456782599100003',  // Test data for Sofort
            'bic' => 'TESTTEST',
            'amount' => 100000,
            'currency' => 'EUR',
            'reference' => uniqid(),
            'narrative_text' => 'Just an order',
            'successurl' => 'https://yourshop.de/payment/success?reference=your_unique_reference',
            'errorurl' => 'https://yourshop.de/payment/error?reference=your_unique_reference',
            'backurl' => 'https://yourshop.de/payment/back?reference=your_unique_reference',
        ];
    }
}
