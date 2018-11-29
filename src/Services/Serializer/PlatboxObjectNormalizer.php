<?php

namespace Platbox\Services\Serializer;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Clear null fields
 *
 * @package PlatboxProxy\utils\Serializer
 */
class PlatboxObjectNormalizer extends ObjectNormalizer
{
    /**
     * @inheritdoc
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = parent::normalize($object, $format, $context);

        return array_filter($data, function ($value) {
            return !is_null($value);
        });
    }
}
