<?php

namespace Platbox\Services\Payment;

use Platbox\Structure\Account\Account;
use Platbox\Structure\Order\Order;
use Platbox\Structure\Payer\Payer;
use Platbox\Structure\Payment\Payment;
use Platbox\Structure\Receipt\Receipt;
use Platbox\Structure\Redirect\Redirect;

/**
 * Class PaymentData
 *
 * @package Platbox\Services\Payment
 */
class PaymentData
{
    /**
     * @var Account
     */
    private $account;

    /**
     * @var Payer
     */
    private $payer = null;

    /**
     * @var Payment
     */
    private $payment;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var Receipt
     */
    private $receipt = null;

    /**
     * @var Redirect
     */
    private $redirect;

    /**
     * PaymentData constructor.
     *
     * @param Account  $account
     * @param Payment  $payment
     * @param Order    $order
     * @param Payer    $payer
     * @param Receipt  $receipt
     * @param Redirect $redirect
     */
    public function __construct(Account $account, Payment $payment, Order $order, Payer $payer = null, Receipt $receipt = null, Redirect $redirect = null)
    {
        $this->account  = $account;
        $this->payment  = $payment;
        $this->order    = $order;
        $this->payer    = $payer;
        $this->receipt  = $receipt;
        $this->redirect = $redirect;
    }

    /**
     * @return Redirect
     */
    public function getRedirect(): ?Redirect
    {
        return $this->redirect;
    }

    /**
     * @param Redirect $redirect
     */
    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    /**
     * @return Receipt
     */
    public function getReceipt(): ?Receipt
    {
        return $this->receipt;
    }

    /**
     * @param Receipt $receipt
     */
    public function setReceipt(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }

    /**
     * @return Account
     */
    public function getAccount(): Account
    {
        return $this->account;
    }

    /**
     * @param Account $account
     */
    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    /**
     * @return Payer
     */
    public function getPayer(): ?Payer
    {
        return $this->payer;
    }

    /**
     * @param Payer $payer
     */
    public function setPayer(Payer $payer): void
    {
        $this->payer = $payer;
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     */
    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }
}
