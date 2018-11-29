<?php

namespace Platbox\Services\Payment;

use Platbox\Services\Config\PlatboxConfig;

/**
 * Class PlatboxData
 *
 * @package Platbox\Services\Payment
 */
class PlatboxData
{
    /**
     * @var string
     */
    private $paymentHost;

    /**
     * @var string
     */
    private $hashAlgo;

    /**
     * @var bool
     */
    private $testMode;

    /**
     * @var PlatboxConfig
     */
    private $platboxConfig;

    /**
     * PlatboxData constructor.
     *
     * @param string        $paymentHost
     * @param string        $hashAlgo
     * @param bool          $testMode
     * @param PlatboxConfig $platboxConfig
     */
    public function __construct(
        string $paymentHost = null,
        string $hashAlgo = "sha256",
        bool $testMode = true,
        PlatboxConfig $platboxConfig = null
    ) {
        $this->paymentHost   = $paymentHost;
        $this->hashAlgo      = $hashAlgo;
        $this->testMode      = $testMode;
        $this->platboxConfig = $platboxConfig ?? new PlatboxConfig();
    }

    /**
     * @return string
     */
    public function getPaymentHost(): ?string
    {
        return $this->paymentHost;
    }

    /**
     * @param string $paymentHost
     */
    public function setPaymentHost(string $paymentHost): void
    {
        $this->paymentHost = $paymentHost;
    }

    /**
     * @return string
     */
    public function getHashAlgo()
    {
        return $this->hashAlgo;
    }

    /**
     * @param string $hashAlgo
     */
    public function setHashAlgo(string $hashAlgo): void
    {
        $this->hashAlgo = $hashAlgo;
    }

    /**
     * @return string
     */
    public function getIframeHost(): string
    {
        $host = $this->getPaymentHost();

        if (!$host) {
            $host = $this->testMode ?
                $this->platboxConfig->getTestHost() :
                $this->platboxConfig->getProdHost();
        }

        return $host.$this->platboxConfig->getIFramePaymentPagePath();
    }
}
