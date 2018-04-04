<?php

namespace ArvPayoneApi\Request\Refund;

use ArvPayoneApi\Request\GenericRequest;

class Refund
{
    private $txid;
    /**
     * @var GenericRequest
     */
    private $request;

    /**
     * Refund constructor.
     *
     * @param GenericRequest $request
     * @param string $txid
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
