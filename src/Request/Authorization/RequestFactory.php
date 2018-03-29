<?php

namespace ArvPayoneApi\Request\Authorization;

use ArvPayoneApi\Lib\Version;
use ArvPayoneApi\Request\Parts\Config;
use ArvPayoneApi\Request\Parts\Customer;
use ArvPayoneApi\Request\Parts\CustomerAddress;
use ArvPayoneApi\Request\Parts\RedirectUrls;
use ArvPayoneApi\Request\Parts\SepaMandate;
use ArvPayoneApi\Request\Parts\SystemInfo;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\RequestDataContract;
use ArvPayoneApi\Request\RequestFactoryContract;

class RequestFactory implements RequestFactoryContract
{
    /**
     * @param string $paymentMethod
     * @param array $data
     * @param bool $referenceId
     *
     * @throws \Exception
     *
     * @return RequestDataContract
     */
    public static function create($paymentMethod, $data, $referenceId = null)
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

        $systemInfoData = $data['systemInfo'];
        $systemInfo = new SystemInfo(
            $systemInfoData['vendor'],
            Version::getVersion(),
            $systemInfoData['module'],
            $systemInfoData['module_version']
        );
        //TODO: refactor
        switch ($paymentMethod) {
            case PaymentTypes::PAYONE_INVOICE:
                return new Invoice(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $systemInfo
                );
            case PaymentTypes::PAYONE_PRE_PAYMENT:
                return new PrePayment(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $systemInfo
                );
            case PaymentTypes::PAYONE_CASH_ON_DELIVERY:
                return new CashOnDelivery(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $data['shippingProvider']['name'],
                    $systemInfo
                );
            case PaymentTypes::PAYONE_CREDIT_CARD:
                $redirectData = $data['redirect'];
                $urls = new RedirectUrls($redirectData['success'], $redirectData['error'], $redirectData['back']);

                return new Creditcard(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $systemInfo,
                    $urls,
                    $data['pseudocardpan']
                    );
            case PaymentTypes::PAYONE_DIRECT_DEBIT:
                $sepaMandateData = $data['sepaMandate'];
                $sepaMandate = new SepaMandate(
                    $sepaMandateData['identification'],
                    $sepaMandateData['dateofsignature'],
                    $sepaMandateData['iban'],
                    $sepaMandateData['bic'],
                    $sepaMandateData['bankcountry']
                );

                return new DirectDebit(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $systemInfo,
                    $sepaMandate
                    );
            case PaymentTypes::PAYONE_PAY_PAL:
                $redirectData = $data['redirect'];
                $urls = new RedirectUrls($redirectData['success'], $redirectData['error'], $redirectData['back']);

                return new PayPal(
                    $config,
                    $reference,
                    $basket['basketAmount'],
                    $basket['currency'],
                    $customer,
                    $systemInfo,
                    $urls
                );
        }
        throw new \Exception('Unimplemented payment method ' . $paymentMethod);
    }
}
