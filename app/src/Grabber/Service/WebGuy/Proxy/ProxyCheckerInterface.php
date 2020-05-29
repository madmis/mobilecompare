<?php

namespace App\Grabber\Service\WebGuy\Proxy;

/**
 * Interface ProxyCheckerInterface
 * @package App\Grabber\Service\WebGuy\Proxy
 */
interface ProxyCheckerInterface
{
    /**
     * Check proxy. Return TRUE if proxy accessible.
     *
     * @param ProxyDtoInterface $proxy
     *
     * @return bool
     */
    public function check(ProxyDtoInterface $proxy) : bool;

    /**
     * Check proxies list. Return list of accessible.
     *
     * @param array|ProxyDtoInterface[] $proxies
     *
     * @return array|ProxyDtoInterface[]
     */
    public function multiCheck(array $proxies) : array;
}
