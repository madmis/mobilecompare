<?php

namespace App\Grabber\Service\WebGuy\Proxy;

/**
 * Interface ProxyDtoInterface
 * @package App\Grabber\Service\WebGuy\Proxy
 */
interface ProxyDtoInterface
{
    /**
     * @return string
     */
    public function host() : string;

    /**
     * @return string
     */
    public function port() : string;
}
