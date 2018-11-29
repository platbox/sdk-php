<?php

namespace Platbox\Services\Callback;

use Platbox\Structure\Callback\CheckCallbackRequest;
use Platbox\Structure\Callback\CheckCallbackResponse;

/**
 * Class CheckCallback
 *
 * @package Platbox\Services\Callback
 */
class CheckCallback
{
    /**
     * @var CheckCallbackRequest
     */
    private $request;

    /**
     * @var CheckCallbackResponse
     */
    private $response;

    /**
     * @return CheckCallbackRequest
     */
    public function getRequest(): CheckCallbackRequest
    {
        return $this->request;
    }

    /**
     * @param CheckCallbackRequest $request
     */
    public function setRequest(CheckCallbackRequest $request): void
    {
        $this->request = $request;
    }

    /**
     * @return CheckCallbackResponse
     */
    public function getResponse(): CheckCallbackResponse
    {
        return $this->response ?? new CheckCallbackResponse;
    }

    /**
     * @param CheckCallbackResponse $response
     */
    public function setResponse(CheckCallbackResponse $response): void
    {
        $this->response = $response;
    }
}
