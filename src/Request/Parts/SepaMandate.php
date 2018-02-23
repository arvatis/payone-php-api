<?php

namespace ArvPayoneApi\Request\Parts;

class SepaMandate
{
    private $mandateIdentification;
    private $mandateDateofsignature;
    private $iban;
    private $bic;
    private $bankcountry;

    /**
     * SepaMandate constructor.
     *
     * @param string $mandateIdentification
     * @param string $mandateDateofsignature
     * @param string $iban
     * @param string $bic
     * @param string $bankcountry
     */
    public function __construct(
        $mandateIdentification,
        $mandateDateofsignature,
        $iban,
        $bic,
        $bankcountry
    ) {
        $this->mandateIdentification = $mandateIdentification;
        $this->mandateDateofsignature = $mandateDateofsignature;
        $this->iban = $iban;
        $this->bic = $bic;
        $this->bankcountry = $bankcountry;
    }

    /**
     * Getter for MandateIdentification
     *
     * @return string
     */
    public function getMandateIdentification()
    {
        return $this->mandateIdentification;
    }

    /**
     * Getter for MandateDateofsignature
     *
     * @return string
     */
    public function getMandateDateofsignature()
    {
        return $this->mandateDateofsignature;
    }

    /**
     * Getter for Iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Getter for Bic
     *
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
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
}
