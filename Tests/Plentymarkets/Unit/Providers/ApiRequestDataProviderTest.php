<?php

namespace Payone\Tests\Unit\Providers;

use Payone\Helper\PaymentHelper;
use Payone\Providers\ApiRequestDataProvider;
use Payone\Services\SessionStorageService;
use Plenty\Modules\Account\Address\Contracts\AddressRepositoryContract;
use Plenty\Modules\Basket\Models\Basket;
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
            $this->createMock(PaymentHelper::class),
            $this->createMock(AddressRepositoryContract::class),
            $this->createMock(SessionStorageService::class),
            $this->createMock(ItemRepositoryContract::class),
            $this->createMock(CountryRepositoryContract::class),
            $this->createMock(ShippingServiceProviderRepositoryContract::class)
        );
    }

    public function testDataIsAlwaysReturned()
    {
        $basket = $this->createMock(Basket::class);
        $requestData = $this->resource->getPreAuthData($basket);

        //print_r($requestData);

        $this->assertArrayHasKey('basket', $requestData);
        $this->assertArrayHasKey('basketItems', $requestData);
        $this->assertArrayHasKey('shippingAddress', $requestData);
        $this->assertArrayHasKey('country', $requestData);
        $this->assertArrayHasKey('country', $requestData);
    }

}