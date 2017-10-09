<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\CustomerAddress;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\CashOnDelivery;
use ArvPayoneApi\Request\PreAuthorization\Invoice;
use ArvPayoneApi\Request\PreAuthorization\PrePayment;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\RequestFactoryContract;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param bool $referenceId
     * @param array $data
     * @return RequestDataContract
     * @throws \Exception
     */
    public static function create($paymentMethod, $referenceId = false, $data = [])
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
        $basket = $data['basket'];
        $reference = isset($data['order']['orderId']) && $data['order']['orderId'] ?
            'order-' . $data['order']['orderId'] : 'basket-' . $data['basket']['id'];
        switch ($paymentMethod) {
            case PaymentTypes::PAYONE_INVOICE:
                return new Invoice(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer
                );
            case PaymentTypes::PAYONE_PRE_PAYMENT:
                return new PrePayment(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer
                );
            case PaymentTypes::PAYONE_CASH_ON_DELIVERY:
                return new CashOnDelivery(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $data['shippingProvider']['name']
                );
        }
        throw new \Exception('Unimplemented payment method ' . $paymentMethod);
    }
}
