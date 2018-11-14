<?php

namespace Platbox\Dto;

/**
 * Class FrameParamsDto
 *
 * @package Platbox\Dto
 */
class IFrameParamsDto
{
    /**
     * @var string
     */
    public $account_id;

    /**
     * @var string
     */
    public $account_additional = null;

    /**
     * @var string
     */
    public $account_location = null;

    /**
     * @var int
     */
    public $amount;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $merchant_id;

    /**
     * @var string
     */
    public $order;

    /**
     * @var string
     */
    public $order_label = null;

    /**
     * @var string
     */
    public $project;

    /**
     * @var string
     */
    public $receipt_data = null;

    /**
     * @var string
     */
    public $redirect_url = null;

    /**
     * @var string
     */
    public $sign;
}
