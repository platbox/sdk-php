<?php

namespace Platbox\Services\Callback;

use Platbox\Structure\Callback\ErrorCallbackResponse;

/**
 * Class ErrorCallback
 *
 * @package Platbox\Services\Callback
 */
class ErrorCallback
{
    /**
     * @var ErrorCallbackResponse
     */
    private $response;

    /**
     * @return ErrorCallbackResponse
     */
    public function getResponse(): ErrorCallbackResponse
    {
        return $this->response ?? new ErrorCallbackResponse();
    }

    /**
     * @param ErrorCallbackResponse $response
     */
    public function setResponse(ErrorCallbackResponse $response): void
    {
        $this->response = $response;
    }
}
