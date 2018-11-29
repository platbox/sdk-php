<?php

namespace Platbox\Structure\Callback;

/**
 * Class PayCallbackResponse
 *
 * @package Platbox\Structure\Callback
 */
class PayCallbackResponse extends CommonCallbackResponse
{
    /**
     * @var string
     */
    protected $merchant_tx_timestamp = null;

    /**
     * @return string
     */
    public function getMerchantTxTimestamp(): ?string
    {
        return $this->merchant_tx_timestamp;
    }

    /**
     * @param string $merchant_tx_timestamp
     */
    public function setMerchantTxTimestamp(string $merchant_tx_timestamp): void
    {
        $this->merchant_tx_timestamp = $merchant_tx_timestamp;
    }
}
