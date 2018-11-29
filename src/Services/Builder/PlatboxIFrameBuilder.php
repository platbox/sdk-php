<?php

namespace Platbox\Services\Builder;

use Platbox\Exception\PlatboxInvalidFieldException;
use Platbox\Exception\PlatboxRequiredFieldException;
use Platbox\Services\Payment\MerchantData;
use Platbox\Services\Payment\PaymentData;
use Platbox\Services\Payment\PlatboxData;

/**
 * Class PlatboxIFrameBuilder
 *
 * @package Platbox\Services\Builders
 */
class PlatboxIFrameBuilder
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
     * @var PlatboxIFrameValidator
     */
    private $platboxIFrameValidator;

    /**
     * @var PlatboxIFrameGenerator
     */
    private $platboxIFrameGenerator;

    /**
     * PlatboxIFrameBuilder constructor.
     *
     * @param PlatboxIFrameValidator $platboxIFrameValidator
     * @param PlatboxIFrameGenerator $platboxIFrameGenerator
     */
    public function __construct(
        PlatboxIFrameValidator $platboxIFrameValidator = null,
        PlatboxIFrameGenerator $platboxIFrameGenerator = null
    ) {
        $this->platboxIFrameValidator = $platboxIFrameValidator ?? new PlatboxIFrameValidator;
        $this->platboxIFrameGenerator = $platboxIFrameGenerator ?? new PlatboxIFrameGenerator;
    }

    /**
     * @return PaymentData
     */
    public function getPaymentData(): PaymentData
    {
        return $this->paymentData ?? new PaymentData;
    }

    /**
     * @param PaymentData $paymentData
     *
     * @return PlatboxIFrameBuilder
     */
    public function setPaymentData(PaymentData $paymentData): PlatboxIFrameBuilder
    {
        $this->paymentData = $paymentData;

        return $this;
    }

    /**
     * @return MerchantData
     */
    public function getMerchantData(): MerchantData
    {
        return $this->merchantData ?? new MerchantData;
    }

    /**
     * @param MerchantData $merchantData
     *
     * @return PlatboxIFrameBuilder
     */
    public function setMerchantData(MerchantData $merchantData): PlatboxIFrameBuilder
    {
        $this->merchantData = $merchantData;

        return $this;
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
     *
     * @return PlatboxIFrameBuilder
     */
    public function setPlatboxData(PlatboxData $platboxData): PlatboxIFrameBuilder
    {
        $this->platboxData = $platboxData;

        return $this;
    }

    /**
     * @return PlatboxIFrameInterface
     *
     * @throws PlatboxRequiredFieldException
     */
    public function build(): PlatboxIFrameInterface
    {
        $this->platboxIFrameValidator->validate(
            $this->getPaymentData(),
            $this->getMerchantData()
        );

        $this->platboxIFrameGenerator->setPaymentData($this->getPaymentData());
        $this->platboxIFrameGenerator->setMerchantData($this->getMerchantData());
        $this->platboxIFrameGenerator->setPlatboxData($this->getPlatboxData());

        $platboxIFrame = new PlatboxIFrame($this->platboxIFrameGenerator);

        return $platboxIFrame;
    }
}
