<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Mocks\Config;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\RequestFactory;
use ArvPayoneApi\Request\Types;
use ArvPayoneApi\Response\Status;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class ClientTest
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostApi */
    private $client;

    public function setUp()
    {
        $this->client = new PostApi(new ApiClient());
    }

    /**
     * @group online
     */
    public function testBasicRequestSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Sofort', 'authorization'));

        self::assertTrue($response->getSuccess());
        self::assertSame(Status::REDIRECT, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testPrePaymentPreAuthSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('PrePayment', 'preauthorization'));
        print_r($response);
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testCODPreAuthSuccessfullyPlaced()
    {
        $request = RequestMockFactory::getRequestData('CashOnDelivery', 'preauthorization');
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    /**
     * @group online
     */
    public function testInvoicePreAuthSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Invoice', 'preauthorization'));
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testPreauthAndCapture()
    {
        $preAuthRequestData = RequestMockFactory::getRequestData('Invoice', 'preauthorization');
        $response = $this->client->doRequest($preAuthRequestData);
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());

        $order = [];
        $order['orderId'] = 'order-123657';
        $order['amount'] = 10000;
        $order['currency'] = 'EUR';
        $context = Config::getConfig()['api_context'];
        $context['capturemode'] = 'completed';
        $context['sequencenumber'] = 1;
        $context['txid'] = 'preAuthId';
        $context['mode'] = 'test';

        $captureRequestData = [];
        $captureRequestData['context'] = $context;
        $captureRequestData['order'] = $order;

        $request = RequestFactory::create(
            Types::CAPTURE,
            'Invoice',
            $response->getTransactionID(),
            $captureRequestData
        );

        $response = $this->client->doRequest($request->jsonSerialize());
        self::assertSame(Status::APPROVED, $response->getStatus());
        self::assertTrue($response->getSuccess());
    }

    /**
     * @expectedException
     */
    public function testClientErrorResponses()
    {
        $mock = new MockHandler([
            new Response(404, []),
            new Response(500, []),
            new RequestException('Error Communicating with Server', new Request('POST', 'test')),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new ApiClient();
        $client->setClient(new Client(['handler' => $handler]));
        $api = new PostApi($client);
        $response = $api->doRequest([]);

        self::assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Client error: `POST https://api.pay1.de/post-gateway/` resulted in a `404 Not Found` response:'
                    . PHP_EOL . PHP_EOL,
                'status' => '',
                'transactionID' => '',
            ],
            $response->jsonSerialize(),
            true,
            'response was: ' . print_r($response->jsonSerialize(), true)
        );

        $response = $api->doRequest([]);

        self::assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Server error: `POST https://api.pay1.de/post-gateway/` resulted in a `500 Internal Server Error` response:'
                    . PHP_EOL . PHP_EOL,
                'status' => '',
                'transactionID' => '',
            ],
            $response->jsonSerialize(),
            true,
            'response was: ' . print_r($response->jsonSerialize(), true)
        );

        $response = $api->doRequest([]);

        self::assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Error Communicating with Server',
                'status' => '',
                'transactionID' => '',
            ],
            $response->jsonSerialize(),
            true,
            'response was: ' . print_r($response->jsonSerialize(), true)
        );
    }

    /**
     * @group online
     */
    public function testPrePaymentAuthSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('PrePayment', Types::AUTHORIZATION));
        self::assertTrue($response->getSuccess());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testCODAuthSuccessfullyPlaced()
    {
        $request = RequestMockFactory::getRequestData('CashOnDelivery', Types::AUTHORIZATION);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    /**
     * @group online
     */
    public function testInvoiceAuthSuccessfullyPlaced()
    {
        $request = RequestMockFactory::getRequestData('Invoice', Types::AUTHORIZATION);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus());
    }
}
