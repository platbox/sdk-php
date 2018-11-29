<?php

namespace Platbox\Structure\IFrame\Account;

/**
 * Class Account
 *
 * @package Platbox\Services\Payment
 */
class Account
{
    /**
     * @var string
     */
    private $accountId;

    /**
     * @var string
     */
    private $accountAdditional = null;

    /**
     * @var string
     */
    private $accountLocation = null;

    /**
     * Account constructor.
     *
     * @param string $accountId
     * @param string $accountAdditional
     * @param string $accountLocation
     */
    public function __construct(string $accountId, string $accountAdditional = null, string $accountLocation = null)
    {
        $this->accountId         = $accountId;
        $this->accountAdditional = $accountAdditional;
        $this->accountLocation   = $accountLocation;
    }

    /**
     * @return string
     */
    public function getAccountAdditional(): ?string
    {
        return $this->accountAdditional;
    }

    /**
     * @param string $accountAdditional
     */
    public function setAccountAdditional(string $accountAdditional): void
    {
        $this->accountAdditional = $accountAdditional;
    }

    /**
     * @return string
     */
    public function getAccountLocation(): ?string
    {
        return $this->accountLocation;
    }

    /**
     * @param string $accountLocation
     */
    public function setAccountLocation(string $accountLocation): void
    {
        $this->accountLocation = $accountLocation;
    }

    /**
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     */
    public function setAccountId(string $accountId): void
    {
        $this->accountId = $accountId;
    }
}
