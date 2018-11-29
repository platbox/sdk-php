<?php


namespace Platbox\Structure\Callback;

/**
 * Class CallbackPayer
 *
 * @package Platbox\Structure\Callback
 */
class CallbackPayer
{
    /**
     * @var string
     */
    protected $id;

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
}
