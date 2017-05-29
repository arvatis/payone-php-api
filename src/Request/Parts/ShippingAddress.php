<?php

namespace Payone\Request\Parts;

use Payone\Request\RequestDataContract;
use Tests\Payone\Mock\Request\DataAbstract;

class ShippingAddress extends DataAbstract implements RequestDataContract
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
     * @param $firstname
     * @param $lastname
     * @param $street
     * @param $addressaddition
     * @param $zip
     * @param $city
     * @param $country
     */
    public function __construct($firstname, $lastname, $street, $addressaddition, $zip, $city, $country)
    {
        parent::__construct();
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->street = $street;
        $this->addressaddition = $addressaddition;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    public function toArray()
    {
        return [
            'shipping_firstname' => $this->firstname,
            'shipping_lastname' => $this->lastname,
            'shipping_street' => $this->street,
            'shipping_zip' => $this->zip,
            'shipping_city' => $this->city,
            'shipping_country' => $this->country,
        ];
    }
}
