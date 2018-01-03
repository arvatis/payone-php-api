<?php

namespace ArvPayoneApi\Mocks\Request\PayolutionInvoice;

class CaptureData
{
    public function getRequestData()
    {
        return [
            'request' => 'capture',
            'amount' => 100000,
            'currency' => 'EUR',
            'capturemode' => 'completed',
            'sequencenumber' => 1,
            'txid' => '',
            'integrator_name' => 'arvatis media GmbH',
            'integrator_version' => \ArvPayoneApi\Lib\Version::getVersion(),
            'solution_name' => 'plentymarkets 7 Payone plugin',
            'solution_version' => '1'
        ];
    }
}
