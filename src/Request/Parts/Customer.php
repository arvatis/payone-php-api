<?php

namespace ArvPayoneApi\Request\Parts;

use ArvPayoneApi\Request\RequestDataContract;

class Customer implements RequestDataContract
{
    private $salutation;
    private $title;
    private $firstname;
    private $lastname;
    /** @var CustomerAddress */
    private $address;
    private $email;
    private $telephonenumber;
    private $birthday;
    private $language;
    private $gender;
    private $ip;

    /**
     * Customer constructor.
     *
     * @param $title
     * @param $firstname
     * @param $lastname
     * @param CustomerAddress $address
     * @param $email
     * @param $telephonenumber
     * @param string $birthday Y-m-d
     * @param $language
     * @param $gender
     * @param $ip
     */
    public function __construct(
        $title,
        $firstname,
        $lastname,
        CustomerAddress $address,
        $email,
        $telephonenumber,
        $birthday,
        $language,
        $gender,
        $ip
    ) {
        $this->salutation = $gender == 'm' ? 'Herr' : 'Frau';
        $this->title = $title;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->email = $email;
        $this->telephonenumber = $telephonenumber;
        $this->birthday = $birthday;
        $this->language = $language;
        $this->gender = $gender;
        $this->ip = $ip;
    }

    /**
     * Getter for Salutation
     *
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Getter for Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
     * Getter for Address
     *
     * @return CustomerAddress
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Getter for Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Getter for Telephonenumber
     *
     * @return mixed
     */
    public function getTelephonenumber()
    {
        return $this->telephonenumber;
    }

    /**
     * Getter for Birthday
     *
     * @return string
     */
    public function getBirthday()
    {
        return str_replace('-', '', $this->birthday);
    }

    /**
     * Getter for Language
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Getter for Gender
     *
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Getter for Ip
     *
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }
}
