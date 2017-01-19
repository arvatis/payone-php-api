<?php


namespace Payone\Request;

/**
 * Class PreAuthorizationGeneric
 */
class PreAuthorizationGeneric implements RequestDataContract
{

    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $clearingtype;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * PreAuthorizationAbstract constructor.
     * @param $request
     * @param $clearingtype
     * @param $reference
     * @param $amount
     * @param $currency
     */
    public function __construct($request, $clearingtype, $reference, $amount, $currency)
    {
        $this->request = $request;
        $this->clearingtype = $clearingtype;
        $this->reference = $reference;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            "request" => $this->request, // create account receivable
            "clearingtype" => $this->clearingtype, // prepayment
            "reference" => $this->reference, // a unique reference, e.g. order number
            "amount" => $this->amount, // amount in smallest currency unit, i.e. cents
            "currency" => $this->currency,
        ];
    }


}