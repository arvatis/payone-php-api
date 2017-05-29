<?php


use Payone\Methods\PayoneCODPaymentMethod;
use Plenty\Modules\Basket\Contracts\BasketRepositoryContract;
use Plenty\Plugin\ConfigRepository;

class PayoneCODPaymentMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \TypeError
     */
    public function testNameIsString()
    {
        $config = $this->createMock(ConfigRepository::class);
        $config->expects($this->any())
            ->method('get')
            ->will($this->returnValue(null));

        $payment = new PayoneCODPaymentMethod(
            $this->createMock(BasketRepositoryContract::class),
            $config
        );

        $this->assertSame('', $payment->getName());
    }
}
