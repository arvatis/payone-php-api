<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Request\RequetGenerationData;
use ArvPayoneApi\Request\Authorization\RequestFactory as AuthFactory;
use ArvPayoneApi\Request\Capture\CaptureModes;
use ArvPayoneApi\Request\Capture\RequestFactory as CaptureFactory;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory as PreAuthFactory;
use ArvPayoneApi\Request\Refund\RequestFactory as RefundFactory;
use ArvPayoneApi\Request\SerializerFactory;
use ArvPayoneApi\Response\GenericResponse;
use ArvPayoneApi\Response\Status;

abstract class IntegrationTestAbstract extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var PostApi
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new PostApi(new ApiClient(), SerializerFactory::createArraySerializer());
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
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());

        return $response;
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
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapturing(GenericResponse $preAuth)
    {
        $data = RequetGenerationData::getRequestData();
        $data['context']['capturemode'] = CaptureModes::COMPLETED;
        $data['context']['sequencenumber'] = 1;
        $data['context']['txid'] = $preAuth->getTransactionID();

        $request = CaptureFactory::create(
            $this->paymentMethod,
            $preAuth->getTransactionID(),
            $data
        );

        $response = $this->client->doRequest($request);

        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
        self::assertTrue($response->getSuccess());

        return $response;
    }

    /**
     * @depends testCapturing
     * @group online
     */
    public function testRefundAfterCapture(GenericResponse $capture)
    {
        sleep(3);
        $data = RequetGenerationData::getRequestData();
        $data['context']['sequencenumber'] = 2;

        $request = RefundFactory::create(
            $this->paymentMethod,
            $capture->getTransactionID(),
            $data
        );

        $response = $this->client->doRequest($request);

        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
        self::assertTrue($response->getSuccess());
    }

    /**
     * @depends testAuthSuccessfullyPlaced
     * @group online
     */
    public function testRefundAfterAuth(GenericResponse $auth)
    {
        $this->markTestSkipped('Not available for async payments.');
        sleep(3);
        $data = RequetGenerationData::getRequestData();
        $data['context']['sequencenumber'] = 2;

        $request = RefundFactory::create(
            $this->paymentMethod,
            $auth->getTransactionID(),
            $data
        );

        $response = $this->client->doRequest($request);

        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
        self::assertTrue($response->getSuccess());
    }
}
