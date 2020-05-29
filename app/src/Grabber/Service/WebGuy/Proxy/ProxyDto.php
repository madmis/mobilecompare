<?php

namespace App\Grabber\Service\WebGuy\Proxy;

/**
 * Class ProxyDto
 * @package App\Grabber\Service\WebGuy\Proxy
 */
class ProxyDto implements ProxyDtoInterface
{
    /**
     * @var string
     */
    private string $host;

    /**
     * @var string
     */
    private string $port;

    /**
     * @param string $host
     * @param string $port
     */
    public function __construct(string $host, string $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    /**
     * @inheritDoc
     */
    public function host() : string
    {
        return $this->host;
    }

    /**
     * @inheritDoc
     */
    public function port() : string
    {
        return $this->port;
    }
}
