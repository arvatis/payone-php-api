<?php

namespace ArvPayoneApi\Unit\Request\Authorization;

use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\Authorization\RequestFactory;
use ArvPayoneApi\Request\PaymentTypes;

class DirectDebitTest extends \PHPUnit_Framework_TestCase
{
    private $data;
    private $paymentMethod = PaymentTypes::PAYONE_DIRECT_DEBIT;

    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $this->data = RequestGenerationData::getRequestData();
        $this->serializer = new ArraySerializer();
    }

    public function testRequestContainsSepaMandateData()
    {
        $request = RequestFactory::create($this->paymentMethod, $this->data);
        $requestData = $this->serializer->serialize($request);
        self::assertSame('PO-TESTTEST', $requestData['mandate_identification']);
        self::assertSame('20180206', $requestData['mandate_dateofsignature']);
    }
}
