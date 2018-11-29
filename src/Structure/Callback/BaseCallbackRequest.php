<?php

namespace Platbox\Structure\Callback;

/**
 * Class BaseCallbackRequest
 *
 * @package Platbox\Structure\Callback
 */
class BaseCallbackRequest extends BaseCallback
{
    /**
     * @var string
     */
    protected $platbox_tx_id;

    /**
     * @var string
     */
    protected $platbox_tx_created_at;

    /**
     * @var string
     */
    protected $product;

    /**
     * @var string
     */
    protected $order;

    /**
     * @var array
     */
    protected $merchant_extra;

    /**
     * @var CallbackPayment
     */
    protected $payment;

    /**
     * @var CallbackAccount
     */
    protected $account;

    /**
     * @var CallbackPayer
     */
    protected $payer;

    /**
     * @var string
     */
    protected $action;

    /**
     * BaseCallbackRequest constructor.
     *
     * @param string          $platbox_tx_id
     * @param string          $platbox_tx_created_at
     * @param string          $product
     * @param string          $order
     * @param array           $merchant_extra
     * @param CallbackPayment $payment
     * @param CallbackAccount $account
     * @param CallbackPayer   $payer
     * @param string          $action
     */
    public function __construct(
        string $platbox_tx_id = null,
        string $platbox_tx_created_at = null,
        string $product = null,
        string $order = null,
        array $merchant_extra = null,
        CallbackPayment $payment = null,
        CallbackAccount $account = null,
        CallbackPayer $payer = null,
        string $action = ''
    ) {
        $this->platbox_tx_id         = $platbox_tx_id;
        $this->platbox_tx_created_at = $platbox_tx_created_at;
        $this->product               = $product;
        $this->order                 = $order;
        $this->merchant_extra        = $merchant_extra;
        $this->payment               = $payment;
        $this->account               = $account;
        $this->payer                 = $payer;
        $this->action                = $action;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getPlatboxTxId(): string
    {
        return $this->platbox_tx_id;
    }

    /**
     * @param string $platbox_tx_id
     */
    public function setPlatboxTxId(string $platbox_tx_id): void
    {
        $this->platbox_tx_id = $platbox_tx_id;
    }

    /**
     * @return string
     */
    public function getPlatboxTxCreatedAt(): string
    {
        return $this->platbox_tx_created_at;
    }

    /**
     * @param string $platbox_tx_created_at
     */
    public function setPlatboxTxCreatedAt(string $platbox_tx_created_at): void
    {
        $this->platbox_tx_created_at = $platbox_tx_created_at;
    }

    /**
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * @param string $product
     */
    public function setProduct(string $product): void
    {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }

    /**
     * @param string $order
     */
    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getMerchantExtra(): array
    {
        return $this->merchant_extra;
    }

    /**
     * @param array $merchant_extra
     */
    public function setMerchantExtra(array $merchant_extra): void
    {
        $this->merchant_extra = $merchant_extra;
    }

    /**
     * @return CallbackPayment
     */
    public function getPayment(): CallbackPayment
    {
        return $this->payment;
    }

    /**
     * @param CallbackPayment $payment
     */
    public function setPayment(CallbackPayment $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return CallbackAccount
     */
    public function getAccount(): CallbackAccount
    {
        return $this->account;
    }

    /**
     * @param CallbackAccount $account
     */
    public function setAccount(CallbackAccount $account): void
    {
        $this->account = $account;
    }

    /**
     * @return CallbackPayer
     */
    public function getPayer(): CallbackPayer
    {
        return $this->payer;
    }

    /**
     * @param CallbackPayer $payer
     */
    public function setPayer(CallbackPayer $payer): void
    {
        $this->payer = $payer;
    }
}
