<?php

namespace Tests\IFrame;

use PHPUnit\Framework\TestCase;
use Platbox\Services\Builder\PlatboxIFrameBuilder;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;
use Platbox\Structure\IFrame\Account\Account;
use Platbox\Structure\IFrame\Order\Order;
use Platbox\Structure\IFrame\Payment\Payment;

class PlatboxIFrameTest extends TestCase
{
    /**
     * @throws \Platbox\Exception\PlatboxInvalidFieldException
     * @throws \Platbox\Exception\PlatboxRequiredFieldException
     */
    public function testIFrameBuilder()
    {
        $paymentData = new PaymentData(
            new Account(
                'accountId',
                'accountAdditional',
                'accountLocation'
            ),
            new Payment(10001, 'RUB'),
            new Order((string) rand(1111, 9999))
        );

        $platboxData = new PlatboxData(
            "https://payment-playground.platbox.com"
        );

        $merchantData = new MerchantData(
            "477a046a7d20e63624fa5d2d634cbdd5",
            "3f66f166eeb1a590b88d1f19097875ab",
            "merchant_test"
        );

        $iframeBuilder = new PlatboxIFrameBuilder();

        $iframe = $iframeBuilder
            ->setMerchantData($merchantData)
            ->setPaymentData($paymentData)
            ->setPlatboxData($platboxData)
            ->build();

        $url = $iframe->getPaymentLink();

        print $url;

        $this->assertRegexp(
            "/(?=.*payment-playground.platbox.com)(?=.*477a046a7d20e63624fa5d2d634cbdd5)(?=.*account)(?=.*merchant_test)/",
            $url
        );
    }
}
