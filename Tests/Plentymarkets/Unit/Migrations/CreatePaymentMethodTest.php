<?php
namespace Payone\Tests\Unit\Migrations;

use Payone\Helper\PaymentHelper;
use Payone\Methods\PayoneInvoicePaymentMethod;
use Payone\Methods\PayonePaydirektPaymentMethod;
use Payone\Methods\PayonePayolutionInstallmentPaymentMethod;
use Payone\Methods\PayonePayPalPaymentMethod;
use Payone\Methods\PayoneRatePayInstallmentPaymentMethod;
use Payone\Methods\PayoneSofortPaymentMethod;
use Payone\Migrations\CreatePaymentMethods;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;

/**
 * Class PaymentHelperTest
 */
class CreatePaymentMethodTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PaymentMethodRepositoryContract|PHPUnit_Framework_MockObject_MockObject */
    private $paymentRepo;
    /** @var  PaymentHelper */
    private $helper;

    /**
     * @var CreatePaymentMethods
     */
    private $migration;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->paymentRepo = $this->createMock(PaymentMethodRepositoryContract::class);

        $this->paymentRepo->method('allForPlugin')
            ->willReturn(
                [
                    (object)
                    [
                        'paymentKey' => PayoneInvoicePaymentMethod::PAYMENT_CODE,
                        'id' => 'invoice_mop'
                    ]
                    ,
                    (object)
                    [
                        'paymentKey' => PayonePaydirektPaymentMethod::PAYMENT_CODE,
                        'id' => 'direct_mop'
                    ]
                    ,
                    (object)
                    [
                        'paymentKey' => PayonePayolutionInstallmentPaymentMethod::PAYMENT_CODE,
                        'id' => 'inst_mop'
                    ]
                    ,
                    (object)
                    [
                        'paymentKey' => PayonePayPalPaymentMethod::PAYMENT_CODE,
                        'id' => 'invoice_mop'
                    ]
                    ,
                    (object)
                    [
                        'paymentKey' => PayoneRatePayInstallmentPaymentMethod::PAYMENT_CODE,
                        'id' => 'ratepay_inst_mop'
                    ]
                    ,
                    (object)
                    [
                        'paymentKey' => PayoneSofortPaymentMethod::PAYMENT_CODE,
                        'id' => 'sofort_mop'
                    ]

                ]
            );
        $paymentRepository = $this->createMock(PaymentRepositoryContract::class);
        $this->helper = new PaymentHelper($this->paymentRepo, $paymentRepository);
        $this->migration = new CreatePaymentMethods($this->paymentRepo, $this->helper);
    }

    /**
     * @return void
     */
    public function testGetPaymentMethodMop()
    {
        $countOfUnregisteredPayments = 2;
        $this->paymentRepo->expects($this->exactly($countOfUnregisteredPayments))
            ->method('createPaymentMethod');

        $this->migration->run();
    }
}