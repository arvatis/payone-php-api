<?php


namespace Payone\Response;


/**
 * Class GenericResponseTest
 */
class GenericResponseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testResponseContainsBasicData()
    {
        $response = new GenericResponse('');
        $this->assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Payone returned an error: empty response',
                'transactionID' => '',
                'status' => '',
            ],
            $response->toArray(),
            true,
            'response was: ' . print_r($response->toArray(), true)
        );
    }

    /**
     * @return void
     */
    public function testResponseParsing()
    {
        $responseBody = <<<TEXT
param1=1
param2=2 

param3= 3param4=4
param5=5&param6=6
param7=
TEXT;

        $response = new GenericResponse($responseBody);
        $this->assertSame(
            [
                'param1' => '1',
                'param2' => '2',
                'param3' => '3param4=4',
                'param5' => '5&param6=6',
                'param7' => ''
            ],
            $response->getResponseData()
        );
    }

    public function testTransactionDataRetrieval()
    {
        $responseBody = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'Mocks' . DIRECTORY_SEPARATOR . 'Response' . DIRECTORY_SEPARATOR . 'Invoice' . DIRECTORY_SEPARATOR .
            'Authorization.php';

        $response = new GenericResponse($responseBody);

        $this->assertSame('213736587', $response->getTransactionID());
        $this->assertTrue($response->getSuccess());
        $this->assertSame('', $response->getErrorMessage());
        $this->assertSame('APPROVED', $response->getStatus());
    }


}
