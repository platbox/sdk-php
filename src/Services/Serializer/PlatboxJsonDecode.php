<?php

namespace Platbox\Services\Serializer;

use Symfony\Component\Serializer\Encoder\JsonDecode;

/**
 * Class PlatboxJsonDecode
 *
 * @package Platbox\Services\Serializer
 */
class PlatboxJsonDecode extends JsonDecode
{
    /**
     * @param string $data
     * @param string $format
     * @param array  $context
     *
     * @return array
     */
    public function decode($data, $format, array $context = [])
    {
        $decoded = parent::decode($data, $format, $context);

        if(isset($decoded->order) && (is_object($decoded->order) || is_array($decoded->order))) {
            $decoded->order = json_encode($decoded->order);
        }

        return $decoded;
    }
}
