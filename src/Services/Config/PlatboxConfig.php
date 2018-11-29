<?php

namespace Platbox\Services\Config;

/**
 * Class PlatboxConfig
 *
 * @package Platbox\Services\Config
 */
class PlatboxConfig
{
    /**
     * Base hosts
     */
    const TEST_HOST = "https://payment-playground.platbox.com";
    const PROD_HOST = "https://payment.platbox.com";

    /**
     * Iframe payment form path
     */
    const PATH_PAY_FORM = "/paybox";

    /**
     * @return string
     */
    public function getTestHost(): string
    {
        return static::TEST_HOST;
    }

    /**
     * @return string
     */
    public function getProdHost(): string
    {
        return static::PROD_HOST;
    }

    /**
     * @return string
     */
    public function getIFramePaymentPagePath(): string
    {
        return static::PATH_PAY_FORM;
    }
}
