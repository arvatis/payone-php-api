<?php

namespace ArvPayoneApi\Request\Capture;

use ArvPayoneApi\Request\GenericRequest;
use ArvPayoneApi\Request\Parts\Cart;

class Capture
{
    private $txid;
    private $capturemode;
    private $cart;
    /**
     * @var GenericRequest
     */
    private $request;
    private $settleaccount;

    /**
     * Capture constructor.
     *
     * @param GenericRequest $request
     * @param $txid
     * @param $capturemode
     * @param $settleaccount
     * @param Cart $cart
     */
    public function __construct(
        GenericRequest $request,
        $txid,
        $capturemode,
        $settleaccount,
        Cart $cart = null
    ) {
        $this->request = $request;
        $this->txid = $txid;
        $this->capturemode = $capturemode;
        $this->cart = $cart;
        $this->settleaccount = $settleaccount;
    }

    /**
     * Getter for Cart
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
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

    /**
     * Getter for Settleaccount
     * @return mixed
     */
    public function getSettleaccount()
    {
        return $this->settleaccount;
    }


}
