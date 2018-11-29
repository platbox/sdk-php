<?php

namespace Platbox\Services\Builder;

use Platbox\Exception\PlatboxRequiredFieldException;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;

/**
 * Class PlatboxIFrameValidator
 *
 * @package Platbox\Services\Builder
 */
class PlatboxIFrameValidator
{
    /**
     * @param PaymentData  $paymentData
     * @param MerchantData $merchantData
     *
     * @throws PlatboxRequiredFieldException
     */
    public function validate(PaymentData $paymentData, MerchantData $merchantData)
    {
        $this->validatePaymentData($paymentData);
        $this->validateMerchantData($merchantData);
    }

    /**
     * @param PaymentData $paymentData
     *
     * @throws PlatboxRequiredFieldException
     */
    private function validatePaymentData(PaymentData $paymentData)
    {
        if (!$paymentData->getAccount() || !$paymentData->getAccount()->getAccountId()) {
            throw new PlatboxRequiredFieldException("Account not found");
        }

        if (!$paymentData->getOrder() || !$paymentData->getOrder()->getOrder()) {
            throw new PlatboxRequiredFieldException("Order not found");
        }

        if (!$paymentData->getPayment() || !$paymentData->getPayment()->getAmount()) {
            throw new PlatboxRequiredFieldException("Amount not found");
        }
    }

    /**
     * @param MerchantData $merchantData
     *
     * @throws PlatboxRequiredFieldException
     */
    private function validateMerchantData(MerchantData $merchantData)
    {
        if (!$merchantData->getOpenKey()) {
            throw new PlatboxRequiredFieldException("Open key not found");
        }
        if (!$merchantData->getSecretKey()) {
            throw new PlatboxRequiredFieldException("Secret key not found");
        }
        if (!$merchantData->getProject()) {
            throw new PlatboxRequiredFieldException("Project not found");
        }
    }
}
