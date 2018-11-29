<?php

namespace Platbox\Structure\Callback;

/**
 * Class BaseCallbackResponse
 *
 * @package Platbox\Structure\Callback
 */
abstract class BaseCallbackResponse extends BaseCallback
{
    /**
     * @var string
     */
    protected $status = "";

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
