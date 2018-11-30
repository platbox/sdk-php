<?php

use Platbox\Enum\CallbackActionEnum;
use Platbox\Exception\PlatboxBadSignatureException;
use Platbox\Exception\PlatboxException;
use Platbox\Services\Callback\CallbackRequest;
use Platbox\Services\Callback\PlatboxCallbackHandler;
use Platbox\Services\Payment\MerchantData;

require '../vendor/autoload.php';

$inputSign = "354ed405973dd1a6879643e996be9f0718c545f4950beb5d4efe8f8160d6e6a9";

/**
 * Example of input request body.
 * You can use file_get_contents('php://input')
 */
$rawData = "{
            \"action\": \"cancel\",
            \"platbox_tx_id\": \"42\",
            \"platbox_tx_created_at\": \"2017-05-27T02:03:00Z\",
            \"platbox_tx_canceled_at\": \"2017-05-27T02:03:00Z\",
            \"merchant_tx_id\": \"3230\",
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
            },
            \"reason\": {
                \"code\": \"provider_limit_exceeded\",
                \"description\": \"Exceeds payment limit\"
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

if ($action == CallbackActionEnum::CANCEL) {
    $cancelRequest = $callbackHandler->getCancelCallback()->getRequest();

    $inputAmount = $cancelRequest->getPayment()->getAmount();
    $action      = $cancelRequest->getAction();
    $extra       = $cancelRequest->getMerchantExtra();
    $order       = $cancelRequest->getOrder();
    $product     = $cancelRequest->getProduct();
    $reason      = $cancelRequest->getReason();

    $cancelResponse = $callbackHandler->getCancelCallback()->getResponse();
    $cancelResponse->setMerchantTxTimestamp((new DateTime())->format("c"));

    /**
     * Json response
     */
    $result = $callbackHandler->toJson($cancelResponse);

    /**
     * Signature of response
     */
    $generatedSign = $callbackHandler->generateSign($cancelResponse);

    print "Sign to platbox: ".$generatedSign.PHP_EOL;
    print "Body to platbox: ".$result.PHP_EOL;
}

