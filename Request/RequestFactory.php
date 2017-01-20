<?php


namespace Payone\Request;


use Payone\Request\Parts\Config;
use Payone\Request\Parts\Customer;
use Payone\Request\Parts\CustomerAddress;
use Payone\Request\PreAuthorization\CashOnDelivery;
use Payone\Request\PreAuthorization\Invoice;
use Payone\Request\PreAuthorization\PrePayment;

class RequestFactory
{
    /**
     * @param string $requestType
     * @param string $paymentMethod
     * @param string|bool $referenceId Reference to previous request
     * @param array $data
     * @return RequestDataContract
     * @throws \Exception
     */
    public static function create($requestType, $paymentMethod, $referenceId = false, $data = []): RequestDataContract
    {
        switch ($requestType) {
            case Types::PREAUTHORIZATION:
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
                    $customerData['salutation'],
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
                    case 'Invoice':
                        return new Invoice(
                            $config,
                            $order['orderId'],
                            $basket['basketAmount'],
                            $basket['currency'],
                            $customer
                        );
                    case 'PrePayment':
                        return new PrePayment(
                            $config,
                            $order['orderId'],
                            $basket['basketAmount'],
                            $basket['currency'],
                            $customer
                        );
                    case 'CashOnDelivery':
                        return new CashOnDelivery(
                            $config,
                            $order['orderId'],
                            $basket['basketAmount'],
                            $basket['currency'],
                            $customer,
                            $data['shippingProvider']['name']
                        );

                }
        }
        throw new \Exception('Uknown request type ' . $requestType . ' for ' . $paymentMethod . ' payment method.');
    }
}