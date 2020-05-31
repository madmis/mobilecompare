<?php

namespace App\Grabber\Service\WebGuy\Proxy;

/**
 * Class ProxyChecker
 * @package App\Grabber\Service\WebGuy\Proxy
 */
class ProxyChecker implements ProxyCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function check(ProxyDtoInterface $proxy) : bool
    {
        return (bool) @fsockopen($proxy->host(), $proxy->port(), $errno, $errstr, 0.1);
    }

    /**
     * @inheritDoc
     */
    public function multiCheck(array $proxies) : array
    {
        return array_filter($proxies, fn($proxy) => $this->check($proxy));
    }
}
