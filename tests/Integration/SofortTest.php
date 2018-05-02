<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Response\GenericResponse;

/**
 * Class SofortTest
 */
class SofortTest extends IntegrationTestAbstract
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$paymentMethod = PaymentTypes::PAYONE_SOFORT;
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapturing(GenericResponse $preAuth)
    {
        $this->markTestSkipped('Customer action required on PayPal website');
    }

    /**
     * @depends testAuthSuccessfullyPlaced
     * @group online
     */
    public function testDebitAfterAuth(GenericResponse $auth)
    {
        $this->markTestSkipped('Will fail with "Desired status change not possible for this payment process" as Payone callbacks will not be processed.');
    }

    /**
     * @group online
     */
    public function testAuthSuccessfullyPlaced()
    {
        $response = parent::testAuthSuccessfullyPlaced();
        self::assertSame($response->getStatus(), 'REDIRECT');

        return $response;
    }

    /**
     * @group online
     */
    public function testPreAuthSuccessfullyPlaced()
    {
        $response = parent::testPreAuthSuccessfullyPlaced();
        self::assertSame($response->getStatus(), 'REDIRECT');

        return $response;
    }
}
