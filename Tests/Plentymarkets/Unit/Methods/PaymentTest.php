<?php

namespace Payone\Tests\Unit;

use Payone\Helper\PaymentHelper;
use Payone\Mocks\Config;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Plugin\ConfigRepository;

class PaymentTest extends \PHPUnit_Framework_TestCase
{

    public function testConfigContainsBasicSettings()
    {
        $paymentMethodRepo = $this->createMock(PaymentMethodRepositoryContract::class);
        $paymentRepo = $this->createMock(PaymentRepositoryContract::class);
        $config = $this->createMock(ConfigRepository::class);

        $config = new Config();
        $paymentHelper = new PaymentHelper($paymentMethodRepo,$paymentRepo,$config);

        $config = $config->getConfig();
        $paymentMethods = $paymentHelper->getPayolutionPaymentCodes();
        $this->assertTrue(count($paymentMethods) > 0, 'No payment methods defined');

        foreach ($paymentMethods as $method) {
            $this->assertNotEmpty($config[$method . '.' . 'active']);
            $this->assertNotEmpty($config[$method . '.' . 'name']);
            $this->assertNotEmpty($config[$method . '.' . 'description']);
        }
    }
}