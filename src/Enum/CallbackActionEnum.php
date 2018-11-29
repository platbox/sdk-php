<?php

namespace Platbox\Enum;

/**
 * Class CallbackActionEnum
 *
 * @package Platbox\Structure\Callback
 */
class CallbackActionEnum extends PlatboxEnum
{
    /**
     * Check callback
     */
    public const CHECK = "check";

    /**
     * Pay callback
     */
    public const PAY = "pay";

    /**
     * Cancel callback
     */
    public const CANCEL = "cancel";
}
