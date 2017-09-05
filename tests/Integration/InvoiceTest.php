<?php

namespace ArvPayoneApi\Integration;

use ArvPayoneApi\Request\PaymentTypes;

/**
 * Class InvoiceTest
 */
class InvoiceTest extends IntegrationTestAbstract
{
    public function setUp()
    {
        parent::setUp();
        $this->paymentMethod = PaymentTypes::PAYONE_INVOICE;
    }
}
