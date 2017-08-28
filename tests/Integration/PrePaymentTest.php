<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\Types;
use ArvPayoneApi\Response\Status;

/**
 * Class PrePaymentTest
 */
class PrePaymentTest extends \PHPUnit_Framework_TestCase
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
    public function testPrePaymentPreAuthSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('PrePayment', Types::PREAUTHORIZATION));
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());
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

}
