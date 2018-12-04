<?php


namespace Platbox\Structure\Callback;

/**
 * Class CallbackAccount
 *
 * @package Platbox\Structure\Callback
 */
class CallbackAccount
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $location = null;

    /**
     * @var string
     */
    protected $additional = null;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(?string $location): void
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getAdditional(): ?string
    {
        return $this->additional;
    }

    /**
     * @param string $additional
     */
    public function setAdditional(?string $additional): void
    {
        $this->additional = $additional;
    }
}
