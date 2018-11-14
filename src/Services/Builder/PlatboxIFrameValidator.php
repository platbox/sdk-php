<?php


namespace Platbox\Services\Builder;

use Platbox\Exception\PlatboxInvalidFieldException;
use Platbox\Exception\PlatboxRequiredFieldException;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;

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
     * @param PlatboxData  $platboxData
     *
     * @throws PlatboxRequiredFieldException
     * @throws PlatboxInvalidFieldException
     */
    public function validate(PaymentData $paymentData, MerchantData $merchantData, PlatboxData $platboxData)
    {
        $this->validatePaymentData($paymentData);
        $this->validateMerchantData($merchantData);
        $this->validatePlatboxData($platboxData);
    }

    /**
     * @param PaymentData $paymentData
     *
     * @throws PlatboxRequiredFieldException
     * @throws PlatboxInvalidFieldException
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

        if (!is_int($paymentData->getPayment()->getAmount())) {
            throw new PlatboxInvalidFieldException("Amount must be an integer");
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

    /**
     * @param PlatboxData $platboxData
     *
     * @throws PlatboxRequiredFieldException
     */
    private function validatePlatboxData(PlatboxData $platboxData)
    {
        if (!$platboxData->getPaymentHost()) {
            throw new PlatboxRequiredFieldException("Platbox payment host not found");
        }
    }
}
