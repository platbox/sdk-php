<?php

namespace Platbox\Services\Callback;

use Platbox\Structure\Callback\CancelCallbackRequest;
use Platbox\Structure\Callback\CancelCallbackResponse;

/**
 * Class CancelCallback
 *
 * @package Platbox\Services\Callback
 */
class CancelCallback
{
    /**
     * @var CancelCallbackRequest
     */
    private $request;

    /**
     * @var CancelCallbackResponse
     */
    private $response;

    /**
     * @return CancelCallbackRequest
     */
    public function getRequest(): CancelCallbackRequest
    {
        return $this->request;
    }

    /**
     * @param CancelCallbackRequest $request
     */
    public function setRequest(CancelCallbackRequest $request): void
    {
        $this->request = $request;
    }

    /**
     * @return CancelCallbackResponse
     */
    public function getResponse(): CancelCallbackResponse
    {
        return $this->response ?? new CancelCallbackResponse;
    }

    /**
     * @param CancelCallbackResponse $response
     */
    public function setResponse(CancelCallbackResponse $response): void
    {
        $this->response = $response;
    }
}
