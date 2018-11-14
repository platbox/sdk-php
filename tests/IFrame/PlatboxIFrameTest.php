<?php

namespace Tests\IFrame;

use PHPUnit\Framework\TestCase;
use Platbox\Services\Builder\PlatboxIFrameBuilder;
use Platbox\Services\Builder\PlatboxIFrameGenerator;
use Platbox\Services\Builder\PlatboxIFrameValidator;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;
use Platbox\Structure\Account\Account;
use Platbox\Structure\Order\Order;
use Platbox\Structure\Payment\Payment;

class PlatboxIFrameTest extends TestCase
{
    /**
     * @throws \Platbox\Exception\PlatboxInvalidFieldException
     * @throws \Platbox\Exception\PlatboxRequiredFieldException
     */
    public function testIFrameBuilder()
    {
        $iframeBuilder = new PlatboxIFrameBuilder(
            new PlatboxIFrameValidator(),
            new PlatboxIFrameGenerator()
        );

        $paymentData = new PaymentData(
            new Account('daurazov@platbox.com'),
            new Payment(10000, 'RUB'),
            new Order((string) rand(1111, 9999))
        );

        $platboxData = new PlatboxData(
            "https://payment-playground.platbox.com/pay"
        );

        $merchantData = new MerchantData(
            "477a046a7d20e63624fa5d2d634cbdd5",
            "3f66f166eeb1a590b88d1f19097875ab",
            "merchant_test"
        );

        $iframe = $iframeBuilder
            ->setMerchantData($merchantData)
            ->setPaymentData($paymentData)
            ->setPlatboxData($platboxData)
            ->build();

        $url = $iframe->getPaymentLink();

        $this->assertRegexp(
            "/(?=.*payment-playground.platbox.com)(?=.*477a046a7d20e63624fa5d2d634cbdd5)(?=.*daurazov)(?=.*merchant_test)/",
            $url
        );
    }
}
