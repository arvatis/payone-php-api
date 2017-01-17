<?php

namespace Tests\Payone\Unit\Api;

use Payone\Api\Client;
use Payone\Api\PostApi;
use Payone\Api\XmlApi;
use Payone\Response\Status;
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
        $this->markTestSkipped('Requests to external APIs are slow.');
        $client = new PostApi(new Client());
        $response = $client->doRequest(RequestMockFactory::getRequestData('Sofort', 'authorization'));

        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::REDIRECT, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testPrePaymentPreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');
        $client = new PostApi(new Client());
        $response = $client->doRequest(RequestMockFactory::getRequestData('PrePayment', 'preauthorization'));
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @return void
     */
    public function testCODPreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');
        $client = new PostApi(new Client());
        $request = RequestMockFactory::getRequestData('CashOnDelivery', 'preauthorization');
        $response = $client->doRequest($request);
        print_r($request);
        $this->assertTrue($response->getSuccess(),$response->getErrorMessage());
        $this->assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    /**
     * @return void
     */
    public function testInvoicePreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('Requests to external APIs are slow.');
        $client = new PostApi(new Client());
        $response = $client->doRequest(RequestMockFactory::getRequestData('Invoice', 'preauthorization'));
        print_r($response);
        $this->assertTrue($response->getSuccess());
        $this->assertSame(Status::APPROVED, $response->getStatus());
    }
}
