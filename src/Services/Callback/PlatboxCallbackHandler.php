<?php

namespace Platbox\Services\Callback;

use Exception;
use Platbox\Enum\CallbackActionEnum;
use Platbox\Exception\PlatboxBadSignatureException;
use Platbox\Exception\PlatboxException;
use Platbox\Exception\PlatboxInvalidFieldException;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PlatboxData;
use Platbox\Services\Serializer\PlatboxSerializer;
use Platbox\Structure\Callback\BaseCallback;
use Platbox\Structure\Callback\BaseCallbackRequest;
use Platbox\Structure\Callback\CancelCallbackRequest;
use Platbox\Structure\Callback\CheckCallbackRequest;
use Platbox\Structure\Callback\PayCallbackRequest;

/**
 * Class PlatboxCallbackHandler
 *
 * @package Platbox\Services\Callback
 */
class PlatboxCallbackHandler
{
    /**
     * @var MerchantData
     */
    private $merchantData;

    /**
     * @var CallbackRequest
     */
    private $callbackRequest;

    /**
     * @var PlatboxData
     */
    private $platboxData;

    /**
     * @var PlatboxSerializer
     */
    private $serializer;

    /**
     * @var CheckCallback
     */
    private $checkCallback = null;

    /**
     * @var PayCallback
     */
    private $payCallback = null;

    /**
     * @var CancelCallback
     */
    private $cancelCallback = null;

    /**
     * PlatboxCallbackHandler constructor.
     *
     * @param MerchantData      $merchantData
     * @param CallbackRequest   $callbackRequest
     * @param PlatboxData       $platboxData
     * @param PlatboxSerializer $serializer
     */
    public function __construct(
        MerchantData $merchantData = null,
        CallbackRequest $callbackRequest = null,
        PlatboxData $platboxData = null,
        PlatboxSerializer $serializer = null
    ) {
        $this->merchantData    = $merchantData;
        $this->callbackRequest = $callbackRequest;
        $this->platboxData     = $platboxData;
        $this->serializer      = $serializer;
    }

    /**
     * @return MerchantData
     */
    public function getMerchantData(): ?MerchantData
    {
        return $this->merchantData;
    }

    /**
     * @param MerchantData $merchantData
     */
    public function setMerchantData(MerchantData $merchantData): void
    {
        $this->merchantData = $merchantData;
    }

    /**
     * @return CallbackRequest
     */
    public function getCallbackRequest(): ?CallbackRequest
    {
        return $this->callbackRequest;
    }

    /**
     * @param CallbackRequest $callbackRequest
     */
    public function setCallbackRequest(CallbackRequest $callbackRequest): void
    {
        $this->callbackRequest = $callbackRequest;
    }

    /**
     * @return PlatboxData
     */
    public function getPlatboxData(): PlatboxData
    {
        return $this->platboxData ?? new PlatboxData;
    }

    /**
     * @param PlatboxData $platboxData
     */
    public function setPlatboxData(PlatboxData $platboxData): void
    {
        $this->platboxData = $platboxData;
    }

    /**
     * @return PlatboxSerializer
     */
    public function getSerializer(): PlatboxSerializer
    {
        return $this->serializer ?? new PlatboxSerializer;
    }

    /**
     * @return ErrorCallback
     */
    public function getErrorCallback(): ErrorCallback
    {
        $callback = new ErrorCallback;

        return $callback;
    }

    /**
     * @return CancelCallback
     */
    public function getCancelCallback(): CancelCallback
    {
        if ($this->cancelCallback) return $this->cancelCallback;

        $inputRequest = $this->getCallbackRequest()->getInputRequest();

        /**
         * @var CancelCallbackRequest $request
         */
        $request = $this->getSerializer()->deserialize($inputRequest, CancelCallbackRequest::class);

        $this->cancelCallback = new CancelCallback;
        $this->cancelCallback->setRequest($request);

        return $this->cancelCallback;
    }

    /**
     * @return PayCallback
     */
    public function getPayCallback(): PayCallback
    {
        if ($this->payCallback) return $this->payCallback;

        $inputRequest = $this->getCallbackRequest()->getInputRequest();

        /**
         * @var PayCallbackRequest $request
         */
        $request = $this->getSerializer()->deserialize($inputRequest, PayCallbackRequest::class);

        $this->payCallback = new PayCallback;
        $this->payCallback->setRequest($request);

        return $this->payCallback;
    }

    /**
     * @see CallbackActionEnum
     *
     * @return string
     * @throws PlatboxException
     */
    public function getAction(): string
    {
        $inputRequest = $this->getCallbackRequest()->getInputRequest();

        /**
         * @var BaseCallbackRequest $request
         */
        $request = $this->getSerializer()->deserialize($inputRequest, BaseCallbackRequest::class);

        try {
            if (!in_array($request->getAction(), CallbackActionEnum::all())) {
                throw new PlatboxInvalidFieldException("Bad input action: {$request->getAction()}");
            }
        } catch (Exception $e) {
            throw new PlatboxException($e->getMessage(), $e->getCode(), $e);
        }

        return $request->getAction();
    }

    /**
     * @return CheckCallback
     */
    public function getCheckCallback(): CheckCallback
    {
        if ($this->checkCallback) return $this->checkCallback;

        $inputRequest = $this->getCallbackRequest()->getInputRequest();

        /**
         * @var CheckCallbackRequest $request
         */
        $request = $this->getSerializer()->deserialize($inputRequest, CheckCallbackRequest::class);

        $this->checkCallback = new CheckCallback;
        $this->checkCallback->setRequest($request);

        return $this->checkCallback;
    }

    /**
     * @throws PlatboxBadSignatureException
     */
    public function validateSign()
    {
        $ourSign = $this->makeSign(
            $this->getPlatboxData()->getHashAlgo(),
            $this->getCallbackRequest()->getInputRequest(),
            $this->getMerchantData()->getSecretKey()
        );

        if (strcasecmp($ourSign, $this->getCallbackRequest()->getInputSign()) !== 0) {
            throw new PlatboxBadSignatureException(
                sprintf(
                    "Input: %s, generated: %s",
                    $this->getCallbackRequest()->getInputSign(),
                    $ourSign
                )
            );
        }
    }

    /**
     * @param string $algo
     * @param string $data
     * @param string $key
     *
     * @return string
     */
    private function makeSign(string $algo, string $data, string $key)
    {
        return hash_hmac($algo, $data, $key);
    }

    /**
     * @param BaseCallback $callback
     *
     * @return string
     */
    public function generateSign(BaseCallback $callback): string
    {
        return $this->makeSign(
            $this->getPlatboxData()->getHashAlgo(),
            $this->getSerializer()->serialize($callback),
            $this->getMerchantData()->getSecretKey()
        );
    }

    /**
     * @param BaseCallback $callback
     *
     * @return string
     */
    public function toJson(BaseCallback $callback): string
    {
        return $this->getSerializer()->serialize($callback);
    }
}
