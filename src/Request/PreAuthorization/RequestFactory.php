<?php

namespace ArvPayoneApi\Request\PreAuthorization;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\CustomerAddress;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\RequestFactoryContract;

class RequestFactory implements RequestFactoryContract
{
    public static function create($paymentMethod, $referenceId = false, $data = []): RequestDataContract
    {
        $context = $data['context'];
        $config = new Config(
            $context['aid'],
            $context['mid'],
            $context['portalid'],
            $context['key'],
            $context['mode']
        );

        $customerAddressData = $data['shippingAddress'];
        $customerAddress = new CustomerAddress(
            $customerAddressData['street'] . ' ' . $customerAddressData['houseNumber'],
            $customerAddressData['addressaddition'],
            $customerAddressData['postalCode'],
            $customerAddressData['town'],
            $customerAddressData['country']
        );
        $customerData = $data['customer'];
        $customer = new Customer(
            $customerData['title'],
            $customerData['firstname'],
            $customerData['lastname'],
            $customerAddress,
            $customerData['email'],
            $customerData['telephonenumber'],
            $customerData['birthday'],
            $customerData['language'],
            $customerData['gender'],
            $customerData['ip']
        );
        $order = $data['order'];
        $basket = $data['basket'];
        switch ($paymentMethod) {
            case PaymentTypes::PAYONE_INVOICE:
                return new Invoice(
                    $config,
                    $order['orderId'],
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer
                );
            case PaymentTypes::PAYONE_PRE_PAYMENT:
                return new PrePayment(
                    $config,
                    $order['orderId'],
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer
                );
            case PaymentTypes::PAYONE_CASH_ON_DELIVERY:
                return new CashOnDelivery(
                    $config,
                    $order['orderId'],
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $data['shippingProvider']['name']
                );
        }
        throw new \Exception('Uknown payment method ' . $paymentMethod);
    }
}
