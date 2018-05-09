<?php

namespace ArvPayoneApi\Request\Debit;

use ArvPayoneApi\Request\GenericRequest;
use ArvPayoneApi\Request\Parts\Cart;

class Debit
{
    private $txid;
    /**
     * @var GenericRequest
     */
    private $request;
    /** @var Cart */
    private $cart;

    /**
     * Debit constructor.
     *
     * @param GenericRequest $request
     * @param $txid
     * @param Cart $cart
     */
    public function __construct(GenericRequest $request, $txid, Cart $cart = null)
    {
        $this->txid = $txid;
        $this->request = $request;
        $this->cart = $cart;
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
     * Getter for Txid
     *
     * @return string
     */
    public function getTxid()
    {
        return $this->txid;
    }

    /**
     * Getter for Cart
     * @return Cart
     */
    public function getCart()
    {
        return $this->cart;
    }
}
