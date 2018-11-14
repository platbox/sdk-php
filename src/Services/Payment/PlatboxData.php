<?php

namespace Platbox\Services\Payment;

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
     * PlatboxData constructor.
     *
     * @param string $paymentHost
     * @param string $hashAlgo
     */
    public function __construct(string $paymentHost, string $hashAlgo = "sha256")
    {
        $this->paymentHost = $paymentHost;
        $this->hashAlgo    = $hashAlgo;
    }

    /**
     * @return string
     */
    public function getPaymentHost(): string
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
}
