<?php

namespace Tests\Callback;

use Platbox\Services\Callback\CallbackRequest;
use Platbox\Services\Callback\PlatboxCallbackHandler;
use PHPUnit\Framework\TestCase;
use Platbox\Services\Payment\MerchantData;
use Platbox\Enum\CallbackActionEnum;
use Platbox\Enum\PlatboxErrorCodeEnum;

/**
 * Class PlatboxCallbackTest
 *
 * @package Tests\Callback
 */
class PlatboxCallbackTest extends TestCase
{
    /**
     * @throws \Platbox\Exception\PlatboxBadSignatureException
     * @throws \Platbox\Exception\PlatboxException
     */
    public function testCancelCallbackHandler()
    {
        $inputSign = "7be5b3508a286757ffce56587a60abcae92ef845b3353536097af7d72d24ae62";

        $rawData = "{
            \"action\": \"cancel\",
            \"platbox_tx_id\": \"42\",
            \"platbox_tx_created_at\": \"2014-10-12T00:13:37Z\",
            \"platbox_tx_canceled_at\": \"2014-10-12T00:13:44Z\",
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
        $callbackHandler->validateSign();

        $this->assertEquals($callbackHandler->getAction(), CallbackActionEnum::CANCEL);

        $cancelCallback = $callbackHandler->getCancelCallback();

        $cancelRequest = $cancelCallback->getRequest();

        $inputAmount = $cancelRequest->getPayment()->getAmount();
        $action      = $cancelRequest->getAction();
        $extra       = $cancelRequest->getMerchantExtra();
        $order       = $cancelRequest->getOrder();
        $product     = $cancelRequest->getProduct();
        $reason      = $cancelRequest->getReason();

        $this->assertEquals($inputAmount, 10000);
        $this->assertEquals($action, CallbackActionEnum::CANCEL);
        $this->assertEquals($order, "314542341");
        $this->assertEquals($product, "legend_of_zelda");
        $this->assertEquals($reason->getCode(), "provider_limit_exceeded");
        $this->assertEquals($reason->getDescription(), "Exceeds payment limit");
        $this->assertTrue(is_object($extra));

        $cancelResponse = $cancelCallback->getResponse();

        $result = $callbackHandler->getSerializer()->serialize($cancelResponse);
        $this->assertEquals('{"status":"ok"}', $result);

        $cancelResponse->setMerchantTxTimestamp((new \DateTime("2018-01-02 03:04:05"))->format("c"));

        $result = $callbackHandler->getSerializer()->serialize($cancelResponse);
        $this->assertEquals('{"merchant_tx_timestamp":"2018-01-02T03:04:05+00:00","status":"ok"}', $result);

        $generatedSign = $callbackHandler->generateSign($cancelResponse);

        $this->assertTrue(is_string($generatedSign) && strlen($generatedSign) == 64);

        $errorCallback = $callbackHandler->getErrorCallback();

        $errorResponse = $errorCallback->getResponse();
        $errorResponse->setCode(PlatboxErrorCodeEnum::PAYMENT_ALREADY_NOT_ACTIVE);
        $errorResponse->setDescription("Order already exists");

        $result = $callbackHandler->getSerializer()->serialize($errorResponse);
        $this->assertEquals(
            '{"code":3000,"description":"Order already exists","status":"error"}',
            $result
        );

        $result = $callbackHandler->toJson($errorResponse);
        $this->assertEquals(
            '{"code":3000,"description":"Order already exists","status":"error"}',
            $result
        );
    }

    /**
     * @throws \Platbox\Exception\PlatboxBadSignatureException
     * @throws \Platbox\Exception\PlatboxException
     */
    public function testPayCallbackHandler()
    {
        $inputSign = "2124e9c34bb2f87ad3d6ee2c31a656ddc04f9c691370c425ecf38e2f55790cfd";

        $rawData = '{"action":"pay","platbox_tx_succeeded_at":"2018-12-04T14:30:56Z","merchant_tx_id":"sandy_1543933856_4732","merchant_tx_extra":{"test_flag":true},"platbox_tx_id":"46831","platbox_tx_created_at":"2018-12-04T14:30:56Z","product":"sandy_merchant_acquiring","payment":{"amount":10000,"currency":"RUB","exponent":2},"account":{"id":"test@platbox.com","location":"","additional":null},"order":{"type":"order_id","order_id":"TEST_PLATBOX_1909687136"},"merchant_extra":{},"payer":null,"payment_extra":[]}';

        $merchantData = new MerchantData();
        $merchantData->setSecretKey("317035d749530217af0ee049cfea4142");

        $callbackRequest = new CallbackRequest($rawData, $inputSign);

        $callbackHandler = new PlatboxCallbackHandler($merchantData, $callbackRequest);
        $callbackHandler->validateSign();

        $this->assertEquals($callbackHandler->getAction(), CallbackActionEnum::PAY);

        $payCallback = $callbackHandler->getPayCallback();

        $payRequest = $payCallback->getRequest();

        $inputAmount = $payRequest->getPayment()->getAmount();
        $action      = $payRequest->getAction();
        $extra       = $payRequest->getMerchantExtra();
        $order       = $payRequest->getOrder();
        $product     = $payRequest->getProduct();

        $this->assertEquals($inputAmount, 10000);
        $this->assertEquals($action, CallbackActionEnum::PAY);
        $this->assertEquals($order, '{"type":"order_id","order_id":"TEST_PLATBOX_1909687136"}');
        $this->assertEquals($product, "sandy_merchant_acquiring");
        $this->assertTrue(is_object($extra));

        $payResponse = $payCallback->getResponse();

        $result = $callbackHandler->getSerializer()->serialize($payResponse);
        $this->assertEquals('{"status":"ok"}', $result);

        $payResponse->setMerchantTxTimestamp((new \DateTime("2018-01-01 00:01:02"))->format("c"));

        $result = $callbackHandler->getSerializer()->serialize($payResponse);
        $this->assertEquals('{"merchant_tx_timestamp":"2018-01-01T00:01:02+00:00","status":"ok"}', $result);

        $generatedSign = $callbackHandler->generateSign($payResponse);

        $this->assertTrue(is_string($generatedSign) && strlen($generatedSign) == 64);

        $errorCallback = $callbackHandler->getErrorCallback();

        $errorResponse = $errorCallback->getResponse();
        $errorResponse->setCode(PlatboxErrorCodeEnum::PAYMENT_ALREADY_NOT_ACTIVE);
        $errorResponse->setDescription("Order already exists");

        $result = $callbackHandler->getSerializer()->serialize($errorResponse);
        $this->assertEquals(
            '{"code":3000,"description":"Order already exists","status":"error"}',
            $result
        );

        $result = $callbackHandler->toJson($errorResponse);
        $this->assertEquals(
            '{"code":3000,"description":"Order already exists","status":"error"}',
            $result
        );
    }

    /**
     * @throws \Platbox\Exception\PlatboxBadSignatureException
     * @throws \Platbox\Exception\PlatboxException
     */
    public function testCheckCallbackHandler()
    {
        $inputSign = "a4e1a25ece3ecd9e6e230774886c7fe21ce7af5cf90bed0e3a2cbaaf9c8ed221";

        $rawData = '{"action":"check","platbox_tx_id":"46829","platbox_tx_created_at":"2018-12-04T13:07:46Z","product":"sandy_merchant_acquiring","payment":{"amount":10000,"currency":"RUB","exponent":2},"account":{"id":"test@platbox.com","location":"","additional":null},"order":{"type":"order_id","order_id":"TEST_PLATBOX_1980387919"},"merchant_extra":{},"payer":null,"payment_extra":[]}';

        $merchantData = new MerchantData();
        $merchantData->setSecretKey("317035d749530217af0ee049cfea4142");

        $callbackRequest = new CallbackRequest($rawData, $inputSign);

        $callbackHandler = new PlatboxCallbackHandler($merchantData, $callbackRequest);
        $callbackHandler->validateSign();

        $this->assertEquals($callbackHandler->getAction(), CallbackActionEnum::CHECK);

        $checkCallback = $callbackHandler->getCheckCallback();

        $checkRequest = $checkCallback->getRequest();

        $inputAmount = $checkRequest->getPayment()->getAmount();
        $action      = $checkRequest->getAction();
        $extra       = $checkRequest->getMerchantExtra();
        $order       = $checkRequest->getOrder();
        $product     = $checkRequest->getProduct();

        $this->assertEquals($inputAmount, 10000);
        $this->assertEquals($action, CallbackActionEnum::CHECK);
        $this->assertEquals($order, '{"type":"order_id","order_id":"TEST_PLATBOX_1980387919"}');
        $this->assertEquals($product, "sandy_merchant_acquiring");
        $this->assertTrue(is_object($extra));

        $checkResponse = $checkCallback->getResponse();

        $checkResponse->setMerchantTxId(159);

        $result = $callbackHandler->getSerializer()->serialize($checkResponse);

        $this->assertEquals('{"merchant_tx_id":"159","status":"ok"}', $result);

        $checkResponse->setMerchantTxExtra(["custom" => false, "custom2" => "0"]);

        $result = $callbackHandler->getSerializer()->serialize($checkResponse);
        $this->assertEquals(
            '{"merchant_tx_extra":{"custom":false,"custom2":"0"},"merchant_tx_id":"159","status":"ok"}',
            $result
        );

        $generatedSign = $callbackHandler->generateSign($checkResponse);

        $this->assertTrue(is_string($generatedSign) && strlen($generatedSign) == 64);

        $errorCallback = $callbackHandler->getErrorCallback();

        $errorResponse = $errorCallback->getResponse();
        $errorResponse->setCode(PlatboxErrorCodeEnum::INTERNAL_ERROR);
        $errorResponse->setDescription("Order already exists");

        $result = $callbackHandler->getSerializer()->serialize($errorResponse);
        $this->assertEquals(
            '{"code":1000,"description":"Order already exists","status":"error"}',
            $result
        );

        $result = $callbackHandler->toJson($errorResponse);
        $this->assertEquals(
            '{"code":1000,"description":"Order already exists","status":"error"}',
            $result
        );
    }
}
