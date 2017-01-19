<?php


namespace Payone\Request\Parts;


use Payone\Request\RequestDataContract;

class CustomerAddress implements RequestDataContract
{
    private $street;
    private $addressaddition;
    private $zip;
    private $city;
    private $country;

    /**
     * CustomerAddress constructor.
     * @param $street
     * @param $addressaddition
     * @param $zip
     * @param $city
     * @param $country
     */
    public function __construct($street, $addressaddition, $zip, $city, $country)
    {
        $this->street = $street;
        $this->addressaddition = $addressaddition;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    public function toArray()
    {
        return [
            'street' => $this->street,
            'addressaddition' => $this->addressaddition,
            'zip' => $this->zip,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}