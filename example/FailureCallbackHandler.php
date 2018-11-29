<?php

require '../vendor/autoload.php';

use Platbox\Enum\CallbackActionEnum;
use Platbox\Enum\PlatboxErrorCodeEnum;
use Platbox\Exception\PlatboxBadSignatureException;
use Platbox\Exception\PlatboxException;
use Platbox\Services\Callback\CallbackRequest;
use Platbox\Services\Callback\PlatboxCallbackHandler;
use Platbox\Services\Payment\MerchantData;

/**
 * Example 1
 *
 * In case of bad input sign you should not accept payment
 */
$inputSign = "bad_sign";

$rawData = "{
            \"action\": \"test\",
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
    /**
     * In case of failure handling
     */
    $errorResponse = $callbackHandler->getErrorCallback()->getResponse();

    $errorResponse->setCode(PlatboxErrorCodeEnum::BAD_SIGNATURE);
    $errorResponse->setDescription("Bad sign");

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($errorResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($errorResponse);

    print "Exception: ".$e->getMessage().PHP_EOL;
    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}

/**
 * Example 2
 *
 * You can verify input action.
 */
try {
    $action = $callbackHandler->getAction();
} catch (PlatboxException $e) {
    /**
     * In case of failure handling
     */
    $errorResponse = $callbackHandler->getErrorCallback()->getResponse();

    $errorResponse->setCode(PlatboxErrorCodeEnum::BAD_REQUEST_PARAMS);
    $errorResponse->setDescription("Bad action");

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($errorResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($errorResponse);

    print "Exception: ".$e->getMessage().PHP_EOL;
    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}

/**
 * Example 3
 *
 * You can verify input amount or another parameters.
 */
try {
    $inputAmount = $callbackHandler->getCheckCallback()->getRequest()->getPayment()->getAmount();

    //Validate input amount and amount of your order
    if(true) {
        throw new PlatboxException("Bad input amount");
    }
} catch (PlatboxException $e) {
    /**
     * In case of failure handling
     */
    $errorResponse = $callbackHandler->getErrorCallback()->getResponse();

    $errorResponse->setCode(PlatboxErrorCodeEnum::INVALID_AMOUNT);

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($errorResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($errorResponse);

    print "Exception: ".$e->getMessage().PHP_EOL;
    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}
