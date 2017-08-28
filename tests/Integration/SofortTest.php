<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\Types;
use ArvPayoneApi\Response\Status;

/**
 * Class SofortTest
 */
class SofortTest extends \PHPUnit_Framework_TestCase
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
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Sofort', Types::AUTHORIZATION));

        self::assertTrue($response->getSuccess());
        self::assertSame(Status::REDIRECT, $response->getStatus());
    }

}
