<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Request\RequestDataContract;
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
    private $requestMock;
    /** @var PostApi */
    private $client;

    public function setUp()
    {
        $this->requestMock = self::createMock(RequestDataContract::class);
        $this->requestMock->method('jsonSerialize')->willReturn([]);
        $this->client = new PostApi(new ApiClient());
    }

    /**
     * @group online
     */
    public function testInvalidRequest()
    {

        $response = $this->client->doRequest($this->requestMock);

        self::assertContains('[errormessage] => Parameter {request} faulty or missing', $response->getErrorMessage());
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
        $response = $api->doRequest($this->requestMock);

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

        $response = $api->doRequest($this->requestMock);

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

        $response = $api->doRequest($this->requestMock);

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

}
