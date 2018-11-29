<?php

require '../vendor/autoload.php';

use Platbox\Enum\CallbackActionEnum;
use Platbox\Exception\PlatboxBadSignatureException;
use Platbox\Exception\PlatboxException;
use Platbox\Services\Callback\CallbackRequest;
use Platbox\Services\Callback\PlatboxCallbackHandler;
use Platbox\Services\Payment\MerchantData;

$inputSign = "b9f5e1bd0361a5b9b72aba3e422c968f83eb1ae0930dd0fa612577ef8ff4507b";

$rawData = "{
            \"action\": \"check\",
            \"platbox_tx_id\": \"42\",
            \"platbox_tx_created_at\": \"2014-10-12T00:13:37Z\",
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

if ($action == CallbackActionEnum::CHECK) {
    $checkRequest = $callbackHandler->getCheckCallback()->getRequest();

    /**
     * Input params
     */
    $inputAmount = $checkRequest->getPayment()->getAmount();
    $extra       = $checkRequest->getMerchantExtra();
    $order       = $checkRequest->getOrder();
    $product     = $checkRequest->getProduct();

    /**
     * Money was not charged yet.
     * Validate order params, account etc. on your side
     */

    /**
     * In case of successful validation fill response object
     */
    $checkResponse = $callbackHandler->getCheckCallback()->getResponse();

    $checkResponse->setMerchantTxId("test159");
    $checkResponse->setMerchantTxExtra(["custom" => false, "custom2" => "0"]);

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($checkResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($checkResponse);

    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}
