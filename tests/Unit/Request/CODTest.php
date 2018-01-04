<?php

namespace ArvPayoneApi\Unit\Request;

use ArvPayoneApi\Mocks\Request\RequetGenerationData;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\ArraySerializer;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory;
use ArvPayoneApi\Request\Types;

/**
 * Class CODTest
 */
class CODTest extends \PHPUnit_Framework_TestCase
{
    private $data;
    private $paymentMethod = PaymentTypes::PAYONE_CASH_ON_DELIVERY;

    /**
     * @var ArraySerializer
     */
    private $serializer;

    public function setUp()
    {
        $this->data = RequetGenerationData::getRequestData();
        $this->serializer = new ArraySerializer();
    }

    public function testPreAuthCODSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData($this->paymentMethod, Types::PREAUTHORIZATION, true);
        $request = RequestFactory::create($this->paymentMethod, false, $this->data);
        $requestData = $this->serializer->serialize($request);
        self::assertEquals(
            $requestMockData,
            $requestData,
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData), true)
        );
    }
}
