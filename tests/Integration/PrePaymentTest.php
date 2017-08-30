<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Request\RequetGenerationData;
use ArvPayoneApi\Request\Authorization\RequestFactory as AuthFactory;
use ArvPayoneApi\Request\Capture\RequestFactory as CaptureFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory as PreAuthFactory;
use ArvPayoneApi\Response\Status;

/**
 * Class PrePaymentTest
 */
class PrePaymentTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostApi */
    private $client;

    private $paymentMethod;

    public function setUp()
    {
        $this->client = new PostApi(new ApiClient());
        $this->paymentMethod = PaymentTypes::PAYONE_PRE_PAYMENT;
    }

    /**
     * @group online
     */
    public function testAuthSuccessfullyPlaced()
    {
        $data = RequetGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = AuthFactory::create($this->paymentMethod, false, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testPreAuthSuccessfullyPlaced()
    {
        $data = RequetGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = PreAuthFactory::create($this->paymentMethod, false, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());

        return $response;
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapture($preAuth)
    {
        $data = RequetGenerationData::getRequestData();
        $data['context']['capturemode'] = 'completed';
        $data['context']['sequencenumber'] = 1;
        $data['context']['txid'] = 'preAuthId';

        $request = CaptureFactory::create(
            'Invoice',
            $preAuth->getTransactionID(),
            $data
        );

        $response = $this->client->doRequest($request);
        self::assertSame(Status::APPROVED, $response->getStatus());
        self::assertTrue($response->getSuccess());
    }
}
