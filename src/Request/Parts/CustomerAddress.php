<?php

namespace ArvPayoneApi\Request\Parts;

class CustomerAddress
{
    private $street;
    private $addressaddition;
    private $zip;
    private $city;
    private $country;

    /**
     * CustomerAddress constructor.
     *
     * @param string $street
     * @param string $addressaddition
     * @param string $zip
     * @param string $city
     * @param string $country
     */
    public function __construct($street, $addressaddition, $zip, $city, $country)
    {
        $this->street = $street;
        $this->addressaddition = $addressaddition;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
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
