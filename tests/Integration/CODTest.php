<?php

namespace ArvPayoneApi\Unit\Api;

use ArvPayoneApi\Api\Client as ApiClient;
use ArvPayoneApi\Api\PostApi;
use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Request\RequetGenerationData;
use ArvPayoneApi\Request\Authorization\RequestFactory as AuthFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory as PreAuthFactory;
use ArvPayoneApi\Response\Status;

/**
 * Class CODTest
 */
class CODTest extends \PHPUnit_Framework_TestCase
{
    private $paymentMethod = PaymentTypes::PAYONE_CASH_ON_DELIVERY;
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
        $data = RequetGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = PreAuthFactory::create($this->paymentMethod, false, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }

    /**
     * @group online
     */
    public function testCODAuthSuccessfullyPlaced()
    {
        $data = RequetGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = AuthFactory::create($this->paymentMethod, false, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
    }


}
