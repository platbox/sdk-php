<?php

namespace Platbox\Services\Builder;

/**
 * Class PlatboxIFrame
 *
 * @package Platbox\Services\Payment
 */
class PlatboxIFrame implements PlatboxIFrameInterface
{
    /**
     * @var PlatboxIFrameGenerator
     */
    private $platboxIFrameGenerator;

    /**
     * PlatboxIFrame constructor.
     *
     * @param PlatboxIFrameGenerator $platboxIFrameGenerator
     */
    public function __construct(PlatboxIFrameGenerator $platboxIFrameGenerator)
    {
        $this->platboxIFrameGenerator = $platboxIFrameGenerator;
    }

    /**
     * @return string
     */
    public function getPaymentLink(): string
    {
        return $this->platboxIFrameGenerator->generateIFrameLink();
    }
}
