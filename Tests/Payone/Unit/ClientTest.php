<?php

namespace Tests\Payone\Unit\Api;

use Payone\Api\Client;
use Payone\Api\PostApi;
use Payone\Api\XmlApi;
use Tests\Payone\Mock\RequestMockFactory;

/**
 * Class ClientTest
 *
 * @package Payone\Tests\Unit\Api
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @return void
     */
    public function testBasicRequestSuccessfullyPlaced()
    {
     //   $this->markTestSkipped('Requests to external APIs are slow.');
        $client = new PostApi(new Client());
        $response = $client->doRequest(RequestMockFactory::getRequestData('Sofort', 'authorization'));

        $this->assertTrue($response->getSuccess());
    }
}
