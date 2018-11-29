<?php

require '../vendor/autoload.php';

use Platbox\Services\Builder\PlatboxIFrameBuilder;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;
use Platbox\Structure\IFrame\Account\Account;
use Platbox\Structure\IFrame\Order\Order;
use Platbox\Structure\IFrame\Payment\Payment;

$paymentData = new PaymentData(
    new Account('test'),
    new Payment(10001),
    new Order(42, "#42 (test payment platbox)")
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

try {
    $iframe = $iframeBuilder
        ->setMerchantData($merchantData)
        ->setPaymentData($paymentData)
        ->setPlatboxData($platboxData)
        ->build();

    $result = $iframe->getPaymentLink();
} catch (Exception $e) {
    $result = $e->getMessage();
}

print $result;
