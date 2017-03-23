<?php


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
        ];
    }
}
