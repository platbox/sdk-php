<?php

namespace Platbox\Structure\IFrame\Redirect;

/**
 * Class Redirect
 *
 * @package Platbox\Structure\Redirect
 */
class Redirect
{
    /**
     * @var string
     */
    private $redirectUrl;

    /**
     * Redirect constructor.
     *
     * @param string $redirectUrl
     */
    public function __construct(string $redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->redirectUrl;
    }

    /**
     * @param string $redirectUrl
     */
    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }
}
