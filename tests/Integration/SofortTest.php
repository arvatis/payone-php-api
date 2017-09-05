<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;

/**
 * Class PrePaymentTest
 */
class SofortTest extends IntegrationTestAbstract
{
    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_SOFORT;
    }
}
