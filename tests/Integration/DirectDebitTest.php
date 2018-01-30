<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\Managemandate\ManageMandateRequestFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Response\Status;

/**
 * Class DirectDebitTest
 */
class DirectDebitTest extends IntegrationTestAbstract
{
    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_CASH_ON_DELIVERY;
    }

    /**
     * @group online
     * @return \ArvPayoneApi\Response\ResponseContract
     */
    public function testDoCreateMandate()
    {
        $data = RequestGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = ManageMandateRequestFactory::create(PaymentTypes::PAYONE_DIRECT_DEBIT, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @group online
     * @return \ArvPayoneApi\Response\ResponseContract
     */
    public function testDoCreateMandateInvalidBic()
    {
        $data = RequestGenerationData::getRequestData();
        $data['bankAccount']['bic'] = 'TESTTESX';
        $data['bankAccount']['iban'] = 'DE00123456782599100004';
        $data['customer']['language'] = 'en';
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = ManageMandateRequestFactory::create(PaymentTypes::PAYONE_DIRECT_DEBIT, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue(!$response->getSuccess());
        self::assertSame(Status::ERROR, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }
}
