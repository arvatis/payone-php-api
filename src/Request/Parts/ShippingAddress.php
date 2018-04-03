<?php

namespace ArvPayoneApi\Request\Parts;

use ArvPayoneApi\Request\RequestDataContract;

class ShippingAddress implements RequestDataContract
{
    private $firstname;
    private $lastname;
    private $street;
    private $addressaddition;
    private $zip;
    private $city;
    private $country;

    /**
     * ShippingAddress constructor.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $street
     * @param string $addressaddition
     * @param string $zip
     * @param string $city
     * @param string $country
     */
    public function __construct($firstname, $lastname, $street, $addressaddition, $zip, $city, $country)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->street = $street;
        $this->addressaddition = $addressaddition;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getShippingFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getShippingLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getShippingStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getShippingAddressaddition()
    {
        return $this->addressaddition;
    }

    /**
     * @return mixed
     */
    public function getShippingZip()
    {
        return $this->zip;
    }

    /**
     * @return mixed
     */
    public function getShippingCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getShippingCountry()
    {
        return $this->country;
    }
}
