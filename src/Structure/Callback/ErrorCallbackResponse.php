<?php

namespace Platbox\Structure\Callback;

/**
 * Class ErrorCallbackResponse
 *
 * @package Platbox\Structure\Callback
 */
class ErrorCallbackResponse extends BaseCallbackResponse
{
    /**
     * @var string
     */
    protected $status = "error";

    /**
     * @var int
     */
    protected $code;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
