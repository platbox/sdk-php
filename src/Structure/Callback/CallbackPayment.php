<?php


namespace Platbox\Structure\Callback;

/**
 * Class CallbackPayment
 *
 * @package Platbox\Structure\Callback
 */
class CallbackPayment
{
    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $exponent;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getExponent(): int
    {
        return $this->exponent;
    }

    /**
     * @param int $exponent
     */
    public function setExponent(int $exponent): void
    {
        $this->exponent = $exponent;
    }
}
