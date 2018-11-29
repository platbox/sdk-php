<?php

namespace Platbox\Services\Builder;

use Platbox\Dto\IFrameParamsDto;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;

/**
 * Class PlatboxIFrameGenerator
 *
 * @package Platbox\Services\Builder
 */
class PlatboxIFrameGenerator
{
    /**
     * @var PaymentData
     */
    private $paymentData;

    /**
     * @var MerchantData
     */
    private $merchantData;

    /**
     * @var PlatboxData
     */
    private $platboxData;

    /**
     * @return PaymentData
     */
    public function getPaymentData(): PaymentData
    {
        return $this->paymentData;
    }

    /**
     * @param PaymentData $paymentData
     */
    public function setPaymentData(PaymentData $paymentData): void
    {
        $this->paymentData = $paymentData;
    }

    /**
     * @return MerchantData
     */
    public function getMerchantData(): MerchantData
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
     * @return PlatboxData
     */
    public function getPlatboxData(): PlatboxData
    {
        return $this->platboxData;
    }

    /**
     * @param PlatboxData $platboxData
     */
    public function setPlatboxData(PlatboxData $platboxData): void
    {
        $this->platboxData = $platboxData;
    }

    /**
     * @return string
     */
    public function generateIFrameLink(): string
    {
        $iframeParams = $this->generateAllFrameParams();

        $url = sprintf(
            "%s?%s",
            $this->getPlatboxData()->getIframeHost(),
            http_build_query($iframeParams)
        );

        return $url;
    }

    /**
     * @return string
     */
    private function generateSign()
    {
        $stringParameters = $this->getStringParameters();
        $hashAlgorithm    = $this->getPlatboxData()->getHashAlgo();
        $secretKey        = $this->getMerchantData()->getSecretKey();

        return hash_hmac($hashAlgorithm, $stringParameters, $secretKey);
    }

    /**
     * @return IFrameParamsDto
     */
    private function generateAllFrameParams(): IFrameParamsDto
    {
        $iframeParams = new IFrameParamsDto();

        $iframeParams->amount      = $this->getPaymentData()->getPayment()->getAmount();
        $iframeParams->project     = $this->getMerchantData()->getProject();
        $iframeParams->account_id  = $this->getPaymentData()->getAccount()->getAccountId();
        $iframeParams->currency    = $this->getPaymentData()->getPayment()->getCurrency();
        $iframeParams->merchant_id = $this->getMerchantData()->getOpenKey();
        $iframeParams->order       = $this->getPaymentData()->getOrder()->getOrder();
        $iframeParams->sign        = $this->generateSign();

        $iframeParams->account_additional = $this->getPaymentData()->getAccount()->getAccountAdditional();
        $iframeParams->account_location   = $this->getPaymentData()->getAccount()->getAccountLocation();
        $iframeParams->order_label        = $this->getPaymentData()->getOrder()->getOrderLabel();
        $iframeParams->receipt_data       = $this->getPaymentData()->getReceipt();
        $iframeParams->redirect_url       = $this->getPaymentData()->getRedirect() ? $this->getPaymentData()->getRedirect()->getRedirectUrl() : null;

        return $iframeParams;
    }

    /**
     * Generate string
     *
     * @return string
     */
    private function getStringParameters(): string
    {
        $signature = '';

        $signature .= $this->getPaymentData()->getAccount()->getAccountAdditional();
        $signature .= $this->getPaymentData()->getAccount()->getAccountId();
        $signature .= $this->getPaymentData()->getAccount()->getAccountLocation();
        $signature .= $this->getPaymentData()->getPayment()->getAmount();
        $signature .= $this->getPaymentData()->getPayment()->getCurrency();
        $signature .= $this->getMerchantData()->getOpenKey();
        $signature .= $this->getPaymentData()->getOrder()->getOrder();
        $signature .= $this->getMerchantData()->getProject();
        $signature .= $this->getPaymentData()->getReceipt();
        $signature .= $this->getPaymentData()->getRedirect() ? $this->getPaymentData()->getRedirect()->getRedirectUrl() : null;

        return $signature;
    }
}
