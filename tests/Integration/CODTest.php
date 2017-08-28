<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\Types;
use ArvPayoneApi\Response\Status;

/**
 * Class CODTest
 */
class CODTest extends \PHPUnit_Framework_TestCase
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
    public function testCODPreAuthSuccessfullyPlaced()
    {
        $request = RequestMockFactory::getRequestData('CashOnDelivery', Types::PREAUTHORIZATION);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
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


}
