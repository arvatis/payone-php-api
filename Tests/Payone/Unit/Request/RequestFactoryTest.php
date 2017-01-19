<?php


namespace Payone\Request;

use Tests\Payone\Mock\RequestMockFactory;


/**
 * Class RequestFactoryTest
 */
class RequestFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $data;

    public function setUp()
    {
        $order = [];
        $order['orderId'] = 'order-123657';

        $basket = [];
        $basket['basketAmount'] = 10000;
        $basket['currency'] = 'EUR';
        $basket['shippingAmount'] = 0;
        $basket['itemSum'] = '840.34';

        $basketItem = [];
        $basketItem['name'] = 'Test Item';
        $basketItem['quantity'] = '1';
        $basketItem['itemId'] = '123124';
        $basketItem['price'] = 10000;

        $address = [];
        $address['town'] = 'Kiel';
        $address['postalCode'] = '24118';
        $address['firstname'] = 'Paul';
        $address['lastname'] = 'Neverpayer';
        $address['street'] = 'Fraunhoferstraße';
        $address['houseNumber'] = '2-4';
        $address['addressaddition'] = 'EG';
        $address['country'] = 'DE';

        $customer = [];
        $customer['salutation'] = 'Herr';
        $customer['title'] = 'Dr.';
        $customer['firstname'] = 'Paul';
        $customer['lastname'] = 'Neverpayer';
        $customer['email'] = 'paul.neverpayer@payone.de';
        $customer['telephonenumber'] = '043125968500';
        $customer['birthday'] = '1970-02-04';
        $customer['language'] = 'de';
        $customer['gender'] = 'm';
        $customer['ip'] = '8.8.8.8';

        $context = [];
        $context['aid'] = 25027;
        $context['mid'] = 24067;
        $context['portalid'] = 2025425;
        $context['key'] = 'sfSTWloDrMtbSZGc';
        $context['mode'] = 'test';

        $shippingProvider = [];
        $shippingProvider['name'] = 'DHL';

        $data['basket'] = $basket;
        $data['basketItems'][] = $basketItem;
        $data['shippingAddress'] = $address;
        $data['context'] = $context;
        $data['order'] = $order;
        $data['customer'] = $customer;
        $data['shippingProvider'] = $shippingProvider;

        $this->data = $data;
    }

    /**
     * @return void
     */
    public function testPreAuthInvoiceSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData('Invoice', Types::PREAUTHORIZATION, true);
        $requestData = RequestFactory::create(Types::PREAUTHORIZATION, 'Invoice', false, $this->data);
        $this->assertSame(
            $requestMockData,
            $requestData->toArray(),
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData->toArray()), true)
        );
    }

    /**
     * @return void
     */
    public function testPreAuthCODSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData('CashOnDelivery', Types::PREAUTHORIZATION, true);
        $requestData = RequestFactory::create(Types::PREAUTHORIZATION, 'CashOnDelivery', false, $this->data);
        $this->assertSame(
            $requestMockData,
            $requestData->toArray(),
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData->toArray()), true)
        );
    }

    /**
     * @return void
     */
    public function testPreAuthPrePaymentSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData('PrePayment', Types::PREAUTHORIZATION, true);
        $requestData = RequestFactory::create(Types::PREAUTHORIZATION, 'PrePayment', false, $this->data);
        $this->assertSame(
            $requestMockData,
            $requestData->toArray(),
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData->toArray()), true)
        );
    }


}
