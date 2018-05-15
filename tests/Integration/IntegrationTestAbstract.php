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

    /**
     * @var array
     */
    protected static $requestData;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$client = new PostApi(new ApiClient(), SerializerFactory::createArraySerializer());
        self::$requestData = RequestGenerationData::getRequestData();

    }

    /**
     * @group online
     */
    public function testAuthSuccessfullyPlaced()
    {

        self::$requestData['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = AuthFactory::create(self::$paymentMethod, self::$requestData);
        $response = self::$client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage(). PHP_EOL .
            'Request data: ' . print_r(self::$client->getLastRequestData(), true));
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertFalse(Status::ERROR == $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @group online
     */
    public function testPreAuthSuccessfullyPlaced()
    {

        self::$requestData['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = PreAuthFactory::create(self::$paymentMethod, self::$requestData);
        $response = self::$client->doRequest($request);
        self::assertFalse(Status::ERROR == $response->getStatus(), $response->getErrorMessage(). PHP_EOL .
            'Request data: ' . print_r(self::$client->getLastRequestData(), true));
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapturing(GenericResponse $preAuth)
    {
        sleep(3);
        self::$requestData['context']['sequencenumber'] = 1;
        self::$requestData['context']['txid'] = $preAuth->getTransactionID();

        $request = CaptureFactory::create(self::$paymentMethod, self::$requestData, $preAuth->getTransactionID());

        $response = self::$client->doRequest($request);
        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'PreAuth request id: ' . $preAuth->getTransactionID() . PHP_EOL .
            'Request data: ' . print_r(self::$client->getLastRequestData(), true)
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
        sleep(15);

        self::$requestData['context']['sequencenumber'] = 2;

        $request = RefundFactory::create(
            self::$paymentMethod, self::$requestData, $capture->getTransactionID()
        );

        $response = self::$client->doRequest($request);

        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'Capture request id: ' . $capture->getTransactionID() . PHP_EOL .
            'Request data: ' . print_r(self::$client->getLastRequestData(), true)
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

        self::$requestData['context']['sequencenumber'] = -1; // -1 should never happen. It is necessary as no payone callbacks are

        $request = DebitFactory::create(self::$paymentMethod, self::$requestData, $auth->getTransactionID());

        $response = self::$client->doRequest($request);

        self::assertFalse(
            Status::ERROR == $response->getStatus(),
            $response->getErrorMessage() . 'Auth request id: ' . $auth->getTransactionID(). PHP_EOL .
            'Request data: ' . print_r(self::$client->getLastRequestData(), true)
        );
        self::assertTrue($response->getSuccess());
    }
}
