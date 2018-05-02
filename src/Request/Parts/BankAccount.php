<?php

namespace ArvPayoneApi\Request\Parts;

class BankAccount
{
    /**
     * @var string
     */
    private $bankcountry;
    /**
     * @var string
     */
    private $iban;
    /**
     * @var string
     */
    private $bic;

    private $firstname;
    private $lastname;

    /**
     * BankAccount constructor.
     *
     * @param string $bankcountry
     * @param string $iban
     * @param string $bic
     */
    public function __construct($bankcountry, $holder, $iban, $bic)
    {
        $this->bankcountry = $bankcountry;
        $this->iban = $iban;
        $this->bic = $bic;
        $holderNames = explode(' ', $holder);
        $this->firstname = $holderNames[0] ?? '';
        $this->lastname = $holderNames[1] ?? '';
    }

    /**
     * Getter for Bankcountry
     *
     * @return mixed
     */
    public function getBankcountry()
    {
        return $this->bankcountry;
    }

    /**
     * Getter for Iban
     *
     * @return mixed
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Getter for Bic
     *
     * @return mixed
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * Getter for Firstname
     *
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Getter for Lastname
     *
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }
}
