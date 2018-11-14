<?php

namespace Platbox\Structure\Order;

/**
 * Class Order
 */
class Order
{
    /**
     * @var string
     */
    private $order;

    /**
     * @var string
     */
    private $orderLabel = null;

    /**
     * Order constructor.
     *
     * @param string $order
     * @param string $orderLabel
     */
    public function __construct(string $order, string $orderLabel = null)
    {
        $this->order      = $order;
        $this->orderLabel = $orderLabel;
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
     * @return string
     */
    public function getOrderLabel(): ?string
    {
        return $this->orderLabel;
    }

    /**
     * @param string $orderLabel
     */
    public function setOrderLabel(string $orderLabel): void
    {
        $this->orderLabel = $orderLabel;
    }
}
