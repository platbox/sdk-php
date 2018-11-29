<?php

namespace Platbox\Structure\Callback;

/**
 * Class CheckCallbackResponse
 *
 * @package Platbox\Structure\Callback
 */
class CheckCallbackResponse extends CommonCallbackResponse
{
    /**
     * @var string
     */
    protected $merchant_tx_id;

    /**
     * @var array
     */
    protected $merchant_tx_extra = [];

    /**
     * @return string
     */
    public function getMerchantTxId(): string
    {
        return $this->merchant_tx_id;
    }

    /**
     * @param string $merchant_tx_id
     */
    public function setMerchantTxId(string $merchant_tx_id): void
    {
        $this->merchant_tx_id = $merchant_tx_id;
    }

    /**
     * @return array
     */
    public function getMerchantTxExtra(): array
    {
        return $this->merchant_tx_extra;
    }

    /**
     * @param array $merchant_tx_extra
     */
    public function setMerchantTxExtra(array $merchant_tx_extra): void
    {
        $this->merchant_tx_extra = $merchant_tx_extra;
    }
}
