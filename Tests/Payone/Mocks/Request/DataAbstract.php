<?php
namespace Tests\Payone\Mock\Request;

use Faker;
use Payolution\Tests\Mocks\Faker\Providers\PayoneCountryCode;
use Tests\Payone\Helpers\Config;

/**
 * Class DataAbstract
 */
abstract class DataAbstract
{
    /**
     * @var string
     */
    private $gender;

    /**
     * @var Faker\Generator
     */
    private $faker;

    /**
     * PreCheckData constructor.
     */
    public function __construct()
    {
        $this->faker = Faker\Factory::create('de_DE');
        $this->faker->addProvider(new PayoneCountryCode($this->faker));
        $this->gender = rand(0, 1) > 0.5 ? 'male' : 'female';
    }

    /**
     * @return array
     */
    public function getPersonalData()
    {
        return [
            "salutation" => $this->gender == 'female' ? 'Frau' : 'Herr',
            "title" => 'Dr.',
            "firstname" => $this->faker->firstName($this->gender),
            "lastname" => $this->faker->lastName($this->gender),
            "street" => $this->faker->streetName . ' ' . $this->faker->buildingNumber,
            "addressaddition" => "EG",
            "zip" => $this->faker->postcode,
            "city" => $this->faker->city,
            "country" => 'DE',
            "email" => $this->faker->email,
            "telephonenumber" => $this->faker->phoneNumber,
            "birthday" => $this->faker->dateTimeBetween('-100 years', '-18 years')->format('Ymd'),
            "language" => "de",
            "gender" => substr($this->gender, 0, 1),
            "ip" => $this->faker->ipv4
        ];
    }

    /**
     * @return array
     */
    public function getPersonalDataStatic()
    {
        return [
            "salutation" => "Herr",
            "title" => "Dr.",
            "firstname" => "Paul",
            "lastname" => "Neverpayer",
            "street" => "Fraunhoferstraße 2-4",
            "addressaddition" => "EG",
            "zip" => "24118",
            "city" => "Kiel",
            "country" => "DE",
            "email" => "paul.neverpayer@payone.de",
            "telephonenumber" => "043125968500",
            "birthday" => "19700204",
            "language" => "de",
            "gender" => "m",
            "ip" => "8.8.8.8"
        ];
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        $config = Config::getConfig();
        $data = array_merge(
            $config['api_context'],
            [
                "mode" => "test", // can be "live" for actual transactions
                "api_version" => "3.10",
                "encoding" => "UTF-8"
            ]
        );
        $data['key'] = md5($data['key']);
        return $data;
    }


}

