<?php


namespace Payone\Request\Parts;


use Payone\Request\RequestDataContract;

class Customer implements RequestDataContract
{
    private $salutation;
    private $title;
    private $firstname;
    private $lastname;
    /** @var  CustomerAddress */
    private $address;
    private $email;
    private $telephonenumber;
    private $birthday;
    private $language;
    private $gender;
    private $ip;

    /**
     * Customer constructor.
     * @param $salutation
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
        $salutation,
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
        $this->salutation = $salutation;
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

    public function toArray()
    {
        return array_merge(
            [
                'salutation' => $this->salutation,
                'title' => $this->title,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
            ],
            $this->address->toArray(),
            [
                'email' => $this->email,
                'telephonenumber' => $this->telephonenumber,
                'birthday' => str_replace('-', '', $this->birthday),
                'language' => $this->language,
                'gender' => $this->gender,
                'ip' => $this->ip,
            ]
        );
    }
}