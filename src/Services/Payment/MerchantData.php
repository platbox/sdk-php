<?php

namespace Platbox\Services\Payment;

/**
 * Class MerchantData
 *
 * @package Platbox\Services\Builders
 */
class MerchantData
{
    /**
     * @var string
     */
    private $openKey;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $project;

    /**
     * MerchantData constructor.
     *
     * @param string $openKey
     * @param string $secretKey
     * @param string $project
     */
    public function __construct(string $openKey = null, string $secretKey = null, string $project = null)
    {
        $this->openKey   = $openKey;
        $this->secretKey = $secretKey;
        $this->project   = $project;
    }

    /**
     * @return string
     */
    public function getOpenKey(): ?string
    {
        return $this->openKey;
    }

    /**
     * @param string $openKey
     */
    public function setOpenKey(string $openKey): void
    {
        $this->openKey = $openKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey(string $secretKey): void
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getProject(): ?string
    {
        return $this->project;
    }

    /**
     * @param string $project
     */
    public function setProject(string $project): void
    {
        $this->project = $project;
    }
}
