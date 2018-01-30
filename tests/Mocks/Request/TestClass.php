<?php


namespace ArvPayoneApi\Mocks\Request;


class TestClass
{
    private $intZero = 0;
    private $floatZero = 0.;
    private $null = null;
    private $emptyString = '';

    /**
     * Getter for IntZero
     * @return int
     */
    public function getIntZero()
    {
        return $this->intZero;
    }

    /**
     * Getter for FloatZero
     * @return float
     */
    public function getFloatZero()
    {
        return $this->floatZero;
    }

    /**
     * Getter for Null
     * @return null
     */
    public function getNull()
    {
        return $this->null;
    }

    /**
     * Getter for EmptyString
     * @return string
     */
    public function getEmptyString()
    {
        return $this->emptyString;
    }


}