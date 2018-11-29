<?php

require '../vendor/autoload.php';

use Platbox\Enum\CallbackActionEnum;
use Platbox\Exception\PlatboxBadSignatureException;
use Platbox\Exception\PlatboxException;
use Platbox\Services\Callback\CallbackRequest;
use Platbox\Services\Callback\PlatboxCallbackHandler;
use Platbox\Services\Payment\MerchantData;

$inputSign = "ede121b1e2f36262d83bc72f807ba2e6def9c1756d2d3d70eacae6c3d2b9ce89";

$rawData = "{
            \"action\": \"pay\",
            \"platbox_tx_id\": \"42\",
            \"platbox_tx_created_at\": \"2014-10-12T00:13:37Z\",
            \"platbox_tx_succeeded_at\": \"2014-10-12T00:13:49Z\",
            \"merchant_tx_id\": \"1001\",
            \"merchant_tx_extra\": {
                \"pin_code\": \"17RT42\"
            },
            \"product\": \"legend_of_zelda\",
            \"payment\" : {
                \"amount\": 10000,
                \"currency\": \"RUB\",
                \"exponent\": 2
            },
            \"account\": {
                \"id\": \"player31337\",
                \"location\": 4,
                \"additional\": \"Jane Doe\"
            },
            \"order\": \"314542341\",
            \"merchant_extra\": {
                \"proc_code\": 564
            },
            \"payer\": {
                \"id\": \"**********\"
            }
        }";

$merchantData = new MerchantData();
$merchantData->setSecretKey("3f66f166eeb1a590b88d1f19097875ab");

$callbackRequest = new CallbackRequest($rawData, $inputSign);

$callbackHandler = new PlatboxCallbackHandler($merchantData, $callbackRequest);

try {
    $callbackHandler->validateSign();
} catch (PlatboxBadSignatureException $e) {
    //handle error
    die($e->getMessage());
}

try {
    $action = $callbackHandler->getAction();
} catch (PlatboxException $e) {
    //handle error
    die($e->getMessage());
}

if ($action == CallbackActionEnum::PAY) {

    $payRequest = $callbackHandler->getPayCallback()->getRequest();

    /**
     * Input params
     */
    $inputAmount = $payRequest->getPayment()->getAmount();
    $extra       = $payRequest->getMerchantExtra();
    $order       = $payRequest->getOrder();
    $product     = $payRequest->getProduct();

    /**
     * Money already was charged.
     * Handle payment callback.
     */


    /**
     * In case of successful payment handle
     */
    $payResponse = $callbackHandler->getPayCallback()->getResponse();
    $payResponse->setMerchantTxTimestamp((new DateTime())->format("c"));

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($payResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($payResponse);

    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}
