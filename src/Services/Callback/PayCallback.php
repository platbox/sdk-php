<?php

namespace Platbox\Services\Callback;

use Platbox\Structure\Callback\PayCallbackRequest;
use Platbox\Structure\Callback\PayCallbackResponse;

/**
 * Class PayCallback
 *
 * @package Platbox\Services\Callback
 */
class PayCallback
{
    /**
     * @var PayCallbackRequest
     */
    private $request;

    /**
     * @var PayCallbackResponse
     */
    private $response;

    /**
     * @return PayCallbackRequest
     */
    public function getRequest(): PayCallbackRequest
    {
        return $this->request;
    }

    /**
     * @param PayCallbackRequest $request
     */
    public function setRequest(PayCallbackRequest $request): void
    {
        $this->request = $request;
    }

    /**
     * @return PayCallbackResponse
     */
    public function getResponse(): PayCallbackResponse
    {
        return $this->response ?? new PayCallbackResponse;
    }

    /**
     * @param PayCallbackResponse $response
     */
    public function setResponse(PayCallbackResponse $response): void
    {
        $this->response = $response;
    }
}
