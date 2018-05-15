<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;
use ArvPayoneApi\Response\GenericResponse;

/**
 * Class InvoiceTest
 */
class InvoiceTest extends IntegrationTestAbstract
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$paymentMethod = PaymentTypes::PAYONE_INVOICE;
    }

    /**
     * @group online
     */
    public function testPreAuthSuccessfullyPlaced()
    {
        return parent::testPreAuthSuccessfullyPlaced();
    }

    /**
     * @depends testPreAuthSuccessfullyPlaced
     * @group online
     */
    public function testCapturing(GenericResponse $preAuth)
    {
        return parent::testCapturing($preAuth);
    }
    /**
     * @depends testCapturing
     * @group online
     */
    public function testRefundAfterCapture(GenericResponse $capture)
    {
        $this->markTestSkipped('Will fail with "Desired status change not possible for this payment process" as Payone callbacks will not be processed.');
    }
}
