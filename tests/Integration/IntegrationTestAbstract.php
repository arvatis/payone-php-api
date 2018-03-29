<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\Authorization\RequestFactory as AuthFactory;
use ArvPayoneApi\Request\Capture\RequestFactory as CaptureFactory;
use ArvPayoneApi\Request\Debit\RequestFactory as DebitFactory;
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
    protected static $paymentMethod;

    /**
     * @var PostApi
     */
    protected static $client;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$client = new PostApi(new ApiClient(), SerializerFactory::createArraySerializer());
    }

    /**
     * @group online
     */
    public function testAuthSuccessfullyPlaced()
    {
        $data = RequestGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = AuthFactory::create(self::$paymentMethod, $data);
        $response = self::$client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertFalse(Status::ERROR == $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @group online
     */
    public function testPreAuthSuccessfullyPlaced()
    {
        $data = RequestGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = PreAuthFactory::create(self::$paymentMethod, $data);
        $response = self::$client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertFalse(Status::ERROR == $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapturing(GenericResponse $preAuth)
    {
        $data = RequestGenerationData::getRequestData();
        $data['context']['sequencenumber'] = 1;
        $data['context']['txid'] = $preAuth->getTransactionID();

        $request = CaptureFactory::create(self::$paymentMethod, $data, $preAuth->getTransactionID());

        $response = self::$client->doRequest($request);

        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'PreAuth request id: ' . $preAuth->getTransactionID()
        );
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
        $data = RequestGenerationData::getRequestData();
        $data['context']['sequencenumber'] = 2;

        $request = RefundFactory::create(
            self::$paymentMethod, $data, $capture->getTransactionID()
        );

        $response = self::$client->doRequest($request);

        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'Capture request id: ' . $capture->getTransactionID()
        );
        self::assertTrue($response->getSuccess());
    }

    /**
     * @depends testAuthSuccessfullyPlaced
     * @group online
     */
    public function testDebitAfterAuth(GenericResponse $auth)
    {
        sleep(3);
        $data = RequestGenerationData::getRequestData();
        $data['context']['sequencenumber'] = -1;// -1 should never happen. It is necessary as no payone callbacks are

        $request = DebitFactory::create(self::$paymentMethod, $data, $auth->getTransactionID());

        $response = self::$client->doRequest($request);

        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'Auth request id: ' . $auth->getTransactionID()
        );
        self::assertTrue($response->getSuccess());
    }
}
