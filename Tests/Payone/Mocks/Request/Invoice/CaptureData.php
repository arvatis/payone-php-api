<?php

namespace Tests\Payone\Mock\Request\Invoice;

use Tests\Payone\Mock\Request\DataAbstract;
use Tests\Payone\Mock\Request\RequestContract;

/**
 * Class CaptureData
 */
class CaptureData extends DataAbstract implements RequestContract
{
    /**
     * @return array
     */
    public function getRequestData()
    {
        return [
            'request' => 'capture', // create account receivable
            'amount' => 10000, // amount in smallest currency unit, i.e. cents
            'currency' => 'EUR',
            'capturemode' => 'completed',
            'sequencenumber' => 1,
            'txid' => 'preAuthId',
        ];
    }

    /**
     * @return array
     */
    public function getPersonalData()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getPersonalDataStatic()
    {
        return [];
    }
}
