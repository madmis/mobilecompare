<?php

namespace App\Grabber\Service\WebGuy\Proxy;

/**
 * Interface ProxyProviderInterface
 * @package App\Grabber\Service\WebGuy\Proxy
 */
interface ProxyProviderInterface
{
    /**
     * @return array|ProxyDtoInterface[]
     */
    public function getProxies() : array;
}
