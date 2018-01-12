<?php

namespace ArvPayoneApi\Mocks\Request;

use ArvPayoneApi\Mocks\Config;

class RequetGenerationData
{
    public static function getRequestData()
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
            'version' => '7',
            'module' => 'plentymarkets 7 Payone plugin',
            'module_version' => '1',
        ];

        $data['basket'] = $basket;
        $data['basketItems'][] = $basketItem;
        $data['shippingAddress'] = $address;
        $data['context'] = $context;
        $data['order'] = $order;
        $data['customer'] = $customer;
        $data['shippingProvider'] = $shippingProvider;
        $data['systemInfo'] = $systemInfo;

        return $data;
    }
}
