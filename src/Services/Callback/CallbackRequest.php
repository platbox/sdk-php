<?php

namespace Platbox\Services\Callback;

/**
 * Class CallbackRequest
 *
 * @package Platbox\Services\Callback
 */
class CallbackRequest
{
    /**
     * @var string
     */
    private $inputRequest;

    /**
     * @var string
     */
    private $inputSign;

    /**
     * CallbackRequest constructor.
     *
     * @param string $inputRequest
     * @param string $inputSign
     */
    public function __construct(string $inputRequest = '', string $inputSign = '')
    {
        $this->inputRequest = $inputRequest;
        $this->inputSign    = $inputSign;
    }

    /**
     * @return string
     */
    public function getInputRequest(): string
    {
        return $this->inputRequest;
    }

    /**
     * @param string $inputRequest
     */
    public function setInputRequest(string $inputRequest): void
    {
        $this->inputRequest = $inputRequest;
    }

    /**
     * @return string
     */
    public function getInputSign(): string
    {
        return $this->inputSign;
    }

    /**
     * @param string $inputSign
     */
    public function setInputSign(string $inputSign): void
    {
        $this->inputSign = $inputSign;
    }
}
