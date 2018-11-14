<?php

namespace Platbox\Services\Builder;

/**
 * Interface PlatboxIFrameInterface
 *
 * @package Platbox\Services\Builder
 */
interface PlatboxIFrameInterface
{
    /**
     * Get link to payment form
     *
     * @return string
     */
    public function getPaymentLink(): string;
}
