<?php
namespace Payolution\Tests\Mocks\Faker\Providers;

use Faker\Provider\Base;

/**
 * Class PayoneCountryCode
 */
class PayoneSalutation extends Base
{
    /**
     * @return mixed
     */
    public function payoneCountryCode()
    {
        return static::randomElement(static::$group);
    }
}