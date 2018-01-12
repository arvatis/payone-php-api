<?php

namespace ArvPayoneApi\Mocks\Faker\Providers;

use Faker\Provider\Base;

/**
 * Class PayoneCountryCode
 */
class PayoneSalutation extends Base
{
    /**
     * @var array
     */
    protected static $group = [
    ];

    /**
     * @return mixed
     */
    public function payoneCountryCode()
    {
        return static::randomElement(static::$group);
    }
}
