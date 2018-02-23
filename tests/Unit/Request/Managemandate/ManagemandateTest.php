<?php

namespace ArvPayoneApi\Unit\Request\Managemandate;

use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\Managemandate\ManageMandateRequestFactory;
use ArvPayoneApi\Request\PaymentTypes;

class ManagemandateTest extends \PHPUnit_Framework_TestCase
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

    public function testBankAccountHolderNamesArePassed()
    {
        $request = ManageMandateRequestFactory::create($this->paymentMethod, $this->data);
        $requestData = $this->serializer->serialize($request);
        self::assertSame('Max', $requestData['firstname']);
        self::assertSame('Mustermann', $requestData['lastname']);
    }
}
