<?php

namespace Platbox\Structure\Callback;

use Platbox\Enum\CallbackActionEnum;

/**
 * Class PayCallbackRequest
 *
 * @package Platbox\Structure\Callback
 */
class PayCallbackRequest extends BaseCallbackRequest
{
    /**
     * @var string
     */
    protected $action = CallbackActionEnum::PAY;

    /**
     * @var string
     */
    protected $platbox_tx_succeeded_at;

    /**
     * @return string
     */
    public function getPlatboxTxSucceededAt(): string
    {
        return $this->platbox_tx_succeeded_at;
    }

    /**
     * @param string $platbox_tx_succeeded_at
     */
    public function setPlatboxTxSucceededAt(string $platbox_tx_succeeded_at): void
    {
        $this->platbox_tx_succeeded_at = $platbox_tx_succeeded_at;
    }
}
