<?php

namespace Payolution\Tests\Mocks\Faker\Providers;

use Faker\Provider\Base;

/**
 * Class PayoneCountryCode
 */
class PayoneCountryCode extends Base
{
    /**
     * @var array
     */
    protected static $group = [
        'DE',
        'AT',
        'CH',
        'NL',
    ];

    /**
     * @return mixed
     */
    public function payoneCountryCode()
    {
        return static::randomElement(static::$group);
    }
}
