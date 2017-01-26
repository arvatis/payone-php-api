<?php
namespace Payone\Tests\Unit\Helpers;

use Payone\Helper\PaymentHelper;
use Payone\Methods\PayoneInvoicePaymentMethod;
use Payone\Methods\PayonePaydirektPaymentMethod;
use Payone\Methods\PayonePayolutionInstallmentPaymentMethod;
use Payone\Methods\PayonePayPalPaymentMethod;
use Payone\Methods\PayoneRatePayInstallmentPaymentMethod;
use Payone\Methods\PayoneSofortPaymentMethod;
use Plenty\Modules\Payment\Contracts\PaymentRepositoryContract;
use Plenty\Modules\Payment\Method\Contracts\PaymentMethodRepositoryContract;
use Plenty\Plugin\ConfigRepository;

/**
 * Class PaymentHelperTest
 */
class PaymentHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PaymentHelper */
    private $helper;

    /**
     * @return void
     */
    public function setUp()
    {
        $paymentRepo = $this->createMock(PaymentRepositoryContract::class);
        $paymentMethodRepo = $this->createMock(PaymentMethodRepositoryContract::class);

        $paymentMethodRepo->method('allForPlugin')
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
        $confRepos = $this->createMock(ConfigRepository::class);
        $this->helper = new PaymentHelper($paymentMethodRepo, $paymentRepo, $confRepos);
    }

    /**
     * @return void
     */
    public function testGetPaymentMethodMop()
    {
        $mop = $this->helper->getPayoneMopId(PayonePaydirektPaymentMethod::PAYMENT_CODE);

        $this->assertSame('direct_mop', $mop);
    }
}