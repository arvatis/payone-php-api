<?php

namespace Tests\Payone\Mock\Request\CashOnDelivery;

use Tests\Payone\Mock\Request\DataAbstract;
use Tests\Payone\Mock\Request\RequestContract;

/**
 * Class PreauthorizationData
 */
class PreauthorizationData extends DataAbstract implements RequestContract
{

    /**
     * @return array
     */
    public function getRequestData()
    {
        return [
            "request" => "preauthorization", // create account receivable
            "clearingtype" => "cod", // prepayment
            "reference" => uniqid(), // a unique reference, e.g. order number
            "amount" => 10000, // amount in smallest currency unit, i.e. cents
            "currency" => "EUR",
            'shippingprovider' => 'DHL'
        ];
    }

}