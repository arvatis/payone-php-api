<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;

/**
 * Class PrePaymentTest
 */
class PrePaymentTest extends IntegrationTestAbstract
{
    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_PRE_PAYMENT;
    }
}
