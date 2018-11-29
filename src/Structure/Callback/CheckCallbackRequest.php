<?php

namespace Platbox\Structure\Callback;

use Platbox\Enum\CallbackActionEnum;

/**
 * Class CheckCallbackRequest
 *
 * @package Platbox\Services\Callback
 */
class CheckCallbackRequest extends BaseCallbackRequest
{
    /**
     * @var string
     */
    protected $action = CallbackActionEnum::CHECK;
}
