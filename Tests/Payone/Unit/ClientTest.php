<?php

namespace Tests\Payone\Unit\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Payone\Api\Client as ApiClient;
use Payone\Api\PostApi;
use Payone\Request\RequestFactory;
use Payone\Request\Types;
use Payone\Response\Status;
use Tests\Payone\Helpers\Config;
use Tests\Payone\Mock\RequestMockFactory;

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

    public function testBasicRequestSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Sofort', 'authorization'));

        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::REDIRECT, $response->getStatus());
    }

    public function testPrePaymentPreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $response = $this->client->doRequest(RequestMockFactory::getRequestData('PrePayment', 'preauthorization'));
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }

    public function testCODPreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $request = RequestMockFactory::getRequestData('CashOnDelivery', 'preauthorization');
        $response = $this->client->doRequest($request);
        print_r($request);
        $this->assertTrue($response->getSuccess(), $response->getErrorMessage());
        $this->assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    public function testInvoicePreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Invoice', 'preauthorization'));
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }

    public function testPreauthAndCapture()
    {
        $preAuthRequestData = RequestMockFactory::getRequestData('Invoice', 'preauthorization');
        $response = $this->client->doRequest($preAuthRequestData);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::APPROVED, $response->getStatus());

        //sleep(3);

        print_r($preAuthRequestData);

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

        $response = $this->client->doRequest($request->toArray());
        print_r($response);
        $this->assertSame(Status::APPROVED, $response->getStatus());
        $this->assertTrue($response->getSuccess());
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

        $this->assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Client error: `POST https://api.pay1.de/post-gateway/` resulted in a `404 Not Found` response:'
                    . PHP_EOL . PHP_EOL,
                'status' => '',
                'transactionID' => '',
            ],
            $response->toArray(),
            true,
            'response was: ' . print_r($response->toArray(), true)
        );

        $response = $api->doRequest([]);

        $this->assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Server error: `POST https://api.pay1.de/post-gateway/` resulted in a `500 Internal Server Error` response:'
                    . PHP_EOL . PHP_EOL,
                'status' => '',
                'transactionID' => '',
            ],
            $response->toArray(),
            true,
            'response was: ' . print_r($response->toArray(), true)
        );

        $response = $api->doRequest([]);

        $this->assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Error Communicating with Server',
                'status' => '',
                'transactionID' => '',
            ],
            $response->toArray(),
            true,
            'response was: ' . print_r($response->toArray(), true)
        );
    }

    public function testPrePaymentAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $response = $this->client->doRequest(RequestMockFactory::getRequestData('PrePayment', Types::AUTHORIZATION));
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(9, strlen($response->getTransactionID()));
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }

    public function testCODAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $request = RequestMockFactory::getRequestData('CashOnDelivery', Types::AUTHORIZATION);
        $response = $this->client->doRequest($request);
        //print_r($request);
        print_r($response);
        $this->assertTrue($response->getSuccess(), $response->getErrorMessage());
        $this->assertSame(9, strlen($response->getTransactionID()));
        $this->assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    public function testInvoiceAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');

        $request = RequestMockFactory::getRequestData('Invoice', Types::AUTHORIZATION);
        $response = $this->client->doRequest($request);
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(9, strlen($response->getTransactionID()));
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }
}
