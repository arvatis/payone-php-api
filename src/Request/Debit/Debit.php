<?php

namespace ArvPayoneApi\Request\Debit;

use ArvPayoneApi\Request\GenericRequest;

class Debit
{
    private $txid;
    /**
     * @var GenericRequest
     */
    private $request;

    /**
     * Debit constructor.
     *
     * @param GenericRequest $request
     * @param $txid
     */
    public function __construct(GenericRequest $request, $txid)
    {
        $this->txid = $txid;
        $this->request = $request;
    }

    /**
     * Getter for Request
     * @return GenericRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Getter for Txid
     *
     * @return string
     */
    public function getTxid()
    {
        return $this->txid;
    }
}
