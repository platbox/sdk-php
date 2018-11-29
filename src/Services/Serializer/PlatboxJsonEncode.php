<?php

namespace Platbox\Services\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncode;

/**
 * Filtered empty values
 *
 * Class PlatboxJsonEncode
 *
 * @package Platbox\Services\Serializer
 */
class PlatboxJsonEncode extends JsonEncode
{
    /**
     * @param       $data
     * @param       $format
     * @param array $context
     *
     * @return bool|float|int|string
     */
    public function encode($data, $format, array $context = [])
    {
        if (is_array($data)) {
            ksort($data);
            $data = array_filter($data, function ($element) {
                $flag = !is_null($element);

                if (is_array($element)) {
                    $flag = !empty($element);
                }

                return $flag;
            });
        }

        return parent::encode($data, $format, $context);
    }
}
