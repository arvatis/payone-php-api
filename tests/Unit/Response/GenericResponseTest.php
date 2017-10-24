<?php

namespace ArvPayoneApi\Response;

/**
 * Class GenericResponseTest
 */
class GenericResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testResponseContainsBasicData()
    {
        $response = ResponseFactory::create('');
        self::assertArraySubset(
            [
                'success' => false,
                'errorMessage' => 'Payone returned an error: empty response',
                'transactionID' => '',
                'status' => '',
            ],
            $response->jsonSerialize(),
            true,
            'response was: ' . print_r($response->jsonSerialize(), true)
        );
    }

    public function testResponseParsing()
    {
        $responseBody = <<<TEXT
param1=1
param2=2 

param3= 3param4=4
param5=5&param6=6
param7=
TEXT;

        $response = ResponseFactory::create($responseBody);
        self::assertSame(
            [
                'param1' => '1',
                'param2' => '2',
                'param3' => '3param4=4',
                'param5' => '5&param6=6',
                'param7' => '',
            ],
            $response->getResponseData()
        );
        self::assertSame('', $response->getStatus());
        self::assertSame('', $response->getTransactionID());
    }

    public function testTransactionDataRetrieval()
    {
        $responseBody = include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR
            . 'Mocks' . DIRECTORY_SEPARATOR . 'Response' . DIRECTORY_SEPARATOR . 'Invoice' . DIRECTORY_SEPARATOR .
            'Authorization.php';

        $response = ResponseFactory::create($responseBody);

        self::assertSame('213736587', $response->getTransactionID());
        self::assertTrue($response->getSuccess());
        self::assertSame('', $response->getErrorMessage());
        self::assertSame('APPROVED', $response->getStatus());
    }
}
