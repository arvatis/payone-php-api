<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;

/**
 * Class CODTest
 */
class CODTest extends IntegrationTestAbstract
{
    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_CASH_ON_DELIVERY;
    }
}
