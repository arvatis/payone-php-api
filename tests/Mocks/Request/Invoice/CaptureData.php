<?php

namespace ArvPayoneApi\Mocks\Request\Invoice;

use ArvPayoneApi\Lib\Version;
use ArvPayoneApi\Mocks\Request\DataAbstract;
use ArvPayoneApi\Mocks\Request\RequestContract;

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
            'settleaccount' => 'yes',
            'sequencenumber' => 1,
            'txid' => 'preAuthId',
            'integrator_name' => 'arvatis media GmbH',
            'integrator_version' => Version::getVersion(),
            'solution_name' => 'plentymarkets 7 Payone plugin',
            'solution_version' => '1',
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
