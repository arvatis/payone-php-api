<?php

namespace ArvPayoneApi\Request;

use ArvPayoneApi\Mocks\Request\RequetGenerationData;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory;

/**
 * Class CODTest
 */
class CODTest extends \PHPUnit_Framework_TestCase
{
    private $data;
    private $paymentMethod = PaymentTypes::PAYONE_CASH_ON_DELIVERY;

    public function setUp()
    {
        $this->data = RequetGenerationData::getRequestData();
    }

    public function testPreAuthCODSameAsMock()
    {
        $requestMockData = RequestMockFactory::getRequestData($this->paymentMethod, Types::PREAUTHORIZATION, true);
        $requestData = RequestFactory::create($this->paymentMethod, false, $this->data);
        self::assertEquals(
            $requestMockData,
            $requestData->jsonSerialize(),
            'Differences: ' . PHP_EOL . print_r(array_diff($requestMockData, $requestData->jsonSerialize()), true)
        );
    }
}
