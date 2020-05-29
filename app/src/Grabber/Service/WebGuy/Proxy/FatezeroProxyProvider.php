<?php

namespace App\Grabber\Service\WebGuy\Proxy;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItem;
use Throwable;

/**
 * Class FatezeroProxyProvider
 * @package App\Grabber\Service\WebGuy\Proxy
 */
class FatezeroProxyProvider implements ProxyProviderInterface
{
    /**
     * @inheritDoc
     * @throws InvalidArgumentException
     */
    public function getProxies() : array
    {
        $cache = new FilesystemAdapter();
        /** @var CacheItemInterface $cached */
        $cached = $cache->getItem('proxy_list.fatezero');

        if (!$cached->isHit()) {
            $proxiesRaw = file_get_contents('https://raw.githubusercontent.com/fate0/proxylist/master/proxy.list#');
            $proxyLines = explode("\n", $proxiesRaw);
            $result = [];

            foreach ($proxyLines as $proxyLine) {
                try {
                    $proxy = json_decode($proxyLine, true, 512, JSON_THROW_ON_ERROR);
                    $result[] = new ProxyDto($proxy['host'], $proxy['port']);
                } catch (Throwable $e) {
                    continue;
                }
            }

            $cached->set($result)->expiresAfter(900);
            $cache->save($cached);
        }

        return $cached->get();
    }
}
