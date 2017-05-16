<?php

namespace Payone\Tests\Unit\Providers;

use Payone\Helper\PaymentHelper;
use Payone\Providers\ApiRequestDataProvider;
use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;
use Plenty\Modules\Account\Contact\Contracts\ContactRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
use Plenty\Modules\Frontend\Session\Storage\Contracts\FrontendSessionStorageFactoryContract;
use Plenty\Modules\Item\Item\Contracts\ItemRepositoryContract;
use Plenty\Modules\Order\Shipping\Countries\Contracts\CountryRepositoryContract;
use Plenty\Modules\Order\Shipping\ServiceProvider\Contracts\ShippingServiceProviderRepositoryContract;

/**
 * Class PaymentHelperTest
 */
class ApiRequestDataProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var ApiRequestDataProvider */
    private $resource;

    public function setUp()
    {
        parent::setUp();
        $this->resource = new ApiRequestDataProvider(
            self::createMock(PaymentHelper::class),
            self::createMock(AddressRepositoryContract::class),
            self::createMock(ItemRepositoryContract::class),
            self::createMock(CountryRepositoryContract::class),
            self::createMock(ShippingServiceProviderRepositoryContract::class),
            self::createMock(ContactRepositoryContract::class),
            self::createMock(FrontendSessionStorageFactoryContract::class)
        );
    }

    public function testDataIsAlwaysReturned()
    {
        $basket = self::createMock(Basket::class);
        $requestData = $this->resource->getPreAuthData('', $basket);

        //print_r($requestData);

        self::assertArrayHasKey('basket', $requestData);
        self::assertArrayHasKey('basketItems', $requestData);
        self::assertArrayHasKey('shippingAddress', $requestData);
        self::assertArrayHasKey('country', $requestData);
        self::assertArrayHasKey('customer', $requestData);
    }

}