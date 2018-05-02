<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Request\GenericRequest;

class Capture
{
    private $txid;
    private $capturemode;
    /**
     * @var GenericRequest
     */
    private $request;

    /**
     * Capture constructor.
     *
     * @param GenericRequest $request
     * @param $txid
     * @param $capturemode
     */
    public function __construct(
        GenericRequest $request,
        $txid,
        $capturemode
    ) {
        $this->request = $request;
        $this->txid = $txid;
        $this->capturemode = $capturemode;
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

    /**
     * Getter for Capturemode
     *
     * @return string
     */
    public function getCapturemode()
    {
        return $this->capturemode;
    }

    /**
     * Getter for Request
     *
     * @return GenericRequest
     */
    public function getRequest()
    {
        return $this->request;
    }
}
