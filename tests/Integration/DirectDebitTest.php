<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Helpers\TransactionHelper;
use ArvPayoneApi\Mocks\Config;
use ArvPayoneApi\Mocks\Request\RequestGenerationData;
use ArvPayoneApi\Request\Authorization\RequestFactory as AuthFactory;
use ArvPayoneApi\Request\Managemandate\ManageMandateRequestFactory;
use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Request\PreAuthorization\RequestFactory as PreAuthFactory;
use ArvPayoneApi\Response\ResponseContract;
use ArvPayoneApi\Response\Status;

/**
 * Class DirectDebitTest
 */
class DirectDebitTest extends IntegrationTestAbstract
{
    private $realIban;

    private $realBic;

    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_DIRECT_DEBIT;
        $config = Config::getConfig();
        $this->realBic = $config['test_data']['real_bic'];
        $this->realIban = $config['test_data']['real_iban'];
    }

    /**
     * @group online
     *
     * @return \ArvPayoneApi\Response\ResponseContract
     */
    public function testDoCreateMandate()
    {
        $data = RequestGenerationData::getRequestData();
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $data['sepaMandate']['bic'] = $this->realBic;
        $data['sepaMandate']['iban'] = $this->realIban;
        $data['bankAccount']['bic'] = $data['sepaMandate']['bic'];
        $data['bankAccount']['iban'] = $data['sepaMandate']['iban'];
        $request = ManageMandateRequestFactory::create(PaymentTypes::PAYONE_DIRECT_DEBIT, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());
        $responseData = $response->jsonSerialize();
        self::assertNotEmpty($responseData['responseData']['creditor_identifier']);
        self::assertNotEmpty($responseData['responseData']['mandate_identification']);

        return $response;
    }

    /**
     * @group online
     *
     * @return \ArvPayoneApi\Response\ResponseContract
     */
    public function testDoCreateMandateInvalidBic()
    {
        $data = RequestGenerationData::getRequestData();
        $data['bankAccount']['bic'] = 'TESTTESX';
        $data['bankAccount']['iban'] = 'DE00123456782599100004';
        $data['bankAccount']['bankcountry'] = 'de';
        $data['customer']['language'] = 'en';
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = ManageMandateRequestFactory::create(PaymentTypes::PAYONE_DIRECT_DEBIT, $data);
        $response = $this->client->doRequest($request);
        self::assertTrue(!$response->getSuccess());
        self::assertSame(Status::ERROR, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @depends testDoCreateMandate
     * @group online
     */
    public function testAuthSuccessfullyPlacedWithSepaMandate(ResponseContract $sepaMandate)
    {
        $data = RequestGenerationData::getRequestData();
        $responseData = $sepaMandate->jsonSerialize();
        $sepaMandateData = [
            'creditorIdentifier' => $responseData['responseData']['creditor_identifier'],
            'identification' => $responseData['responseData']['mandate_identification'],
            'dateofsignature' => date('Ymd'),
            'iban' => $this->realIban,
            'bic' => $this->realBic,
            'bankcountry' => 'de',
        ];
        $data['bankAccount']['bic'] = $sepaMandateData['bic'];
        $data['bankAccount']['iban'] = $sepaMandateData['iban'];
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = AuthFactory::create($this->paymentMethod, ['sepaMandate' => $sepaMandateData] + $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(9, strlen($response->getTransactionID()));
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    /**
     * @depends testDoCreateMandate
     * @group online
     */
    public function testPreAuthSuccessfullyPlacedWithSepaMandate(ResponseContract $sepaMandate)
    {
        $data = RequestGenerationData::getRequestData();
        $responseData = $sepaMandate->jsonSerialize();
        $sepaMandateData = [
            'creditorIdentifier' => $responseData['responseData']['creditor_identifier'],
            'identification' => $responseData['responseData']['mandate_identification'],
            'dateofsignature' => date('Ymd'),
            'iban' => $this->realIban,
            'bic' => $this->realBic,
            'bankcountry' => 'de',
        ];
        $data['bankAccount']['bic'] = $sepaMandateData['bic'];
        $data['bankAccount']['iban'] = $sepaMandateData['iban'];
        $data['order']['orderId'] = TransactionHelper::getUniqueTransactionId();
        $request = PreAuthFactory::create($this->paymentMethod, ['sepaMandate' => $sepaMandateData] + $data);
        $response = $this->client->doRequest($request);
        self::assertTrue($response->getSuccess(), $response->getErrorMessage());
        self::assertSame(Status::APPROVED, $response->getStatus(), $response->getErrorMessage());

        return $response;
    }

    public function testAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('covered in $this::testAuthSuccessfullyPlacedWithSepaMandate()');
    }

    public function testPreAuthSuccessfullyPlaced()
    {
        $this->markTestSkipped('covered in $this::testPreAuthSuccessfullyPlacedWithSepaMandate()');
    }
}
