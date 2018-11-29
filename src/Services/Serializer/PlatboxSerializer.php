<?php

namespace Platbox\Services\Serializer;

use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Symfony Serializer Wrapper
 *
 * Class PlatboxSerializer
 *
 * @package Platbox\Services\Serializer
 */
class PlatboxSerializer
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * PlatboxSerializer constructor.
     *
     * @param ObjectNormalizer|null $normalizer
     * @param EncoderInterface|null $encoder
     */
    public function __construct(ObjectNormalizer $normalizer = null, EncoderInterface $encoder = null)
    {
        $normalizer = $normalizer ?? new PlatboxObjectNormalizer(
                null,
                new CamelCaseToSnakeCaseNameConverter()
            );

        $encoder = $encoder ?? new JsonEncoder(new PlatboxJsonEncode());

        $this->serializer = new Serializer([$normalizer], [$encoder]);
    }

    /**
     * Deserialize data into the given type.
     *
     * @param mixed  $data
     * @param string $type
     * @param string $format
     * @param array  $context
     *
     * @return object
     */
    public function deserialize($data, $type, string $format = "json", array $context = [])
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * @param object $object
     * @param string $format
     *
     * @return bool|float|int|string
     */
    public function serialize($object, string $format = "json"): ?string
    {
        return $this->serializer->serialize($object, $format, [
            'json_encode_options' => JSON_FORCE_OBJECT,
        ]);
    }

    /**
     * Convert object to array
     *
     * @param $object
     *
     * @return array
     */
    public function normalize($object): array
    {
        return $this->serializer->normalize($object);
    }
}
