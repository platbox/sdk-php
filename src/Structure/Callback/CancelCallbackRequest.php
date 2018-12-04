<?php

namespace Platbox\Structure\Callback;

use Platbox\Enum\CallbackActionEnum;
use stdClass;

/**
 * Class CancelCallbackRequest
 *
 * @package Platbox\Structure\Callback
 */
class CancelCallbackRequest extends BaseCallbackRequest
{
    /**
     * @var string
     */
    protected $action = CallbackActionEnum::CANCEL;

    /**
     * @var CallbackReason
     */
    protected $reason;

    /**
     * @var string
     */
    protected $platbox_tx_canceled_at;

    /**
     * CancelCallbackRequest constructor.
     *
     * @param string|null          $platbox_tx_id
     * @param string|null          $platbox_tx_created_at
     * @param string|null          $product
     * @param string|null          $order
     * @param stdClass|null        $merchant_extra
     * @param CallbackPayment|null $payment
     * @param CallbackAccount|null $account
     * @param CallbackPayer|null   $payer
     * @param string|null          $action
     * @param CallbackReason|null  $reason
     */
    public function __construct(
        string $platbox_tx_id = null,
        string $platbox_tx_created_at = null,
        string $product = null,
        string $order = null,
        stdClass $merchant_extra = null,
        CallbackPayment $payment = null,
        CallbackAccount $account = null,
        CallbackPayer $payer = null,
        string $action = null,
        CallbackReason $reason = null
    ) {
        $this->reason = $reason;

        parent::__construct($platbox_tx_id, $platbox_tx_created_at, $product, $order, $merchant_extra, $payment,
            $account, $payer, $action);
    }

    /**
     * @return CallbackReason
     */
    public function getReason(): CallbackReason
    {
        return $this->reason;
    }

    /**
     * @param CallbackReason $reason
     */
    public function setReason(CallbackReason $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getPlatboxTxCanceledAt(): string
    {
        return $this->platbox_tx_canceled_at;
    }

    /**
     * @param string $platbox_tx_canceled_at
     */
    public function setPlatboxTxCanceledAt(string $platbox_tx_canceled_at): void
    {
        $this->platbox_tx_canceled_at = $platbox_tx_canceled_at;
    }
}
