<?php

namespace ArvPayoneApi\Unit\Request\Authorization;

use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\Authorization\RequestFactory;
use ArvPayoneApi\Request\PaymentTypes;

class InvoiceSecureTest extends \PHPUnit_Framework_TestCase
{
    private $data;
    private $paymentMethod = PaymentTypes::PAYONE_INVOICE_SECURE;

    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $this->data = RequestGenerationData::getRequestData();
        $this->serializer = new ArraySerializer();
    }

    public function testRequestContainsCartData()
    {
        $request = RequestFactory::create($this->paymentMethod, $this->data);
        $requestData = $this->serializer->serialize($request);
        self::assertTrue((bool)$requestData['id1']);
    }
}
