<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Mocks\Config;
use ArvPayoneApi\Mocks\RequestMockFactory;
use ArvPayoneApi\Request\RequestFactoryContract;
use ArvPayoneApi\Request\Types;
use ArvPayoneApi\Response\Status;

/**
 * Class InvoiceTest
 */
class InvoiceTest extends \PHPUnit_Framework_TestCase
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
    public function testInvoicePreAuthSuccessfullyPlaced()
    {
        $response = $this->client->doRequest(RequestMockFactory::getRequestData('Invoice', 'preauthorization'));
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus());
    }

    /**
     * @group online
     */
    public function testInvoicePreauthAndCapture()
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

        $request = RequestFactoryContract::create(
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
