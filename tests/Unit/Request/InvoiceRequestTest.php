<?php

namespace ArvPayoneApi\Unit\Request;

use ArvPayoneApi\Mocks\Config;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\Capture\RequestFactory as CaptureFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory as PreAuthFactory;
use ArvPayoneApi\Request\Types;

/**
 * Class InvoiceRequestTest
 */
class InvoiceRequestTest extends \PHPUnit_Framework_TestCase
{
    private $data;

    private $paymentMethod = PaymentTypes::PAYONE_INVOICE;

    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $order = [];
        $order['orderId'] = '123657';
        $order['amount'] = 10000;
        $order['currency'] = 'EUR';

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
        $address['lastname'] = 'Payer';
        $address['street'] = 'Fraunhoferstraße';
        $address['houseNumber'] = '2-4';
        $address['addressaddition'] = 'EG';
        $address['country'] = 'DE';

        $customer = [];
        $customer['salutation'] = 'Herr';
        $customer['title'] = 'Dr.';
        $customer['firstname'] = 'Paul';
        $customer['lastname'] = 'Payer';
        $customer['email'] = 'paul.Payer@payone.de';
        $customer['telephonenumber'] = '043125968500';
        $customer['birthday'] = '1970-02-04';
        $customer['language'] = 'de';
        $customer['gender'] = 'm';
        $customer['ip'] = '8.8.8.8';

        $context = Config::getConfig()['api_context'];
        $context['mode'] = 'test';

        $shippingProvider = [];
        $shippingProvider['name'] = 'DHL';

        $systemInfo = [
            'vendor' => 'arvatis media GmbH',
            'version' => 7,
            'module' => 'plentymarkets 7 Payone plugin',
            'module_version' => 1,
        ];

        $data['basket'] = $basket;
        $data['basketItems'][] = $basketItem;
        $data['shippingAddress'] = $address;
        $data['context'] = $context;
        $data['order'] = $order;
        $data['customer'] = $customer;
        $data['shippingProvider'] = $shippingProvider;
        $data['systemInfo'] = $systemInfo;

        $this->data = $data;

        $this->serializer = new ArraySerializer();
    }

    public function testPreAuthInvoiceSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData($this->paymentMethod, Types::PREAUTHORIZATION,
            true);
        $request = PreAuthFactory::create($this->paymentMethod, $this->data);
        $requestData = $this->serializer->serialize($request);
        self::assertEquals(
            $requestMockData,
            $requestData,
            'Differences: ' . PHP_EOL . print_r(
                array_diff($requestMockData, $requestData) +
                array_diff($requestData, $requestMockData),
                true)
        );
    }

    public function testCaptureInvoiceSameAsMock()
    {
        $order = [];
        $order['orderId'] = '123657';
        $order['amount'] = 10000;
        $order['currency'] = 'EUR';
        $context = Config::getConfig()['api_context'];
        $context['capturemode'] = 'completed';
        $context['sequencenumber'] = 1;
        $context['txid'] = 'preAuthId';
        $context['mode'] = 'test';
        $systemInfo = [
            'vendor' => 'arvatis media GmbH',
            'version' => '7',
            'module' => 'plentymarkets 7 Payone plugin',
            'module_version' => '1',
        ];

        $data = [];
        $data['context'] = $context;
        $data['order'] = $order;
        $data['systemInfo'] = $systemInfo;

        $requestMockData = RequestMockFactory::getRequestData($this->paymentMethod, Types::CAPTURE, true);
        $request = CaptureFactory::create($this->paymentMethod, $data, $requestMockData['txid']);
        $requestData = $this->serializer->serialize($request);

        self::assertEquals(
            $requestMockData,
            $requestData,
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData), true)
        );
    }
}
