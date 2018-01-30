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

    /**
     * Getter for Street
     *
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Getter for Addressaddition
     *
     * @return mixed
     */
    public function getAddressaddition()
    {
        return $this->addressaddition;
    }

    /**
     * Getter for Zip
     *
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Getter for City
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Getter for Country
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
}
