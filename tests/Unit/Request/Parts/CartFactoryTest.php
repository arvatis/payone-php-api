<?php

namespace ArvPayoneApi\Unit\Request\Parts;

use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\Parts\Cart;
use ArvPayoneApi\Request\Parts\CartFactory;
use ArvPayoneApi\Request\Parts\CartItem;

class CartFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $data;

    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $this->data = RequestGenerationData::getRequestData();
        $this->serializer = new ArraySerializer();
    }

    public function testCartSerialization()
    {
        $request = CartFactory::create($this->data);
        $requestData = $this->serializer->serialize($request);
        $this->assertHasItems($requestData);
        $this->assertHasShipping($requestData);
        $this->assertCartItemAmountSameAsBasketSum($request);

    }

    public function testCartSerializationWithMultipleItems()
    {
        $this->data = [];
        $basket = [];
        $basketItem = [];

        $basket['basketAmount'] = 11595;
        $basket['currency'] = 'EUR';
        $basket['shippingAmount'] = 595;
        $basket['shippingAmountNet'] = 500;

        $this->data['basket'] = $basket;

        $basketItem['name'] = 'Test Item 1';
        $basketItem['quantity'] = '1';
        $basketItem['itemId'] = '123124';
        $basketItem['price'] = 10000;
        $basketItem['vat'] = 19.;

        $this->data['basketItems'][] = $basketItem;

        $basketItem['name'] = 'Test Item 2';
        $basketItem['quantity'] = '2';
        $basketItem['itemId'] = 'sku2';
        $basketItem['price'] = 500;
        $basketItem['vat'] = 7.;

        $this->data['basketItems'][] = $basketItem;

        $request = CartFactory::create($this->data);
        $requestData = $this->serializer->serialize($request);
        $this->assertHasItems($requestData);
        $this->assertHasShipping($requestData);
        $this->assertShippingTaxIsCorrect($requestData);
        $this->assertCartItemAmountSameAsBasketSum($request);

    }

    /**
     * @param $requestData
     */
    private function assertHasItems($requestData)
    {
        self::assertTrue((bool)$requestData['id0']);
    }

    /**
     * @param $requestData
     */
    private function assertHasShipping($requestData)
    {
        self::assertContains(CartItem::TYPE_SHIPMENt, array_values($requestData));
    }

    /**
     * @param $requestData
     */
    private function assertCartItemAmountSameAsBasketSum(Cart $requestData)
    {
        $cartSum = 0;
        /** @var CartItem $cartItem */
        foreach ($requestData->getCartItems() as $cartItem) {
            $cartSum += $cartItem->getPr() * $cartItem->getNo();
        }
        self::assertSame(
            $this->data['basket']['basketAmount'] ,
            $cartSum
        );
    }

    /**
     * @param $requestData
     */
    private function assertShippingTaxIsCorrect($requestData)
    {
        self::assertSame(
            1900,
            $requestData['va2']
        );
    }
}
