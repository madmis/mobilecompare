<?php

namespace App\Grabber\Service\WebGuy\Task\DeviceSpecifications;

use App\Grabber\Service\WebGuy\{SpiderTaskInterface, WebGuyInterface};

/**
 * Class BrandDevicesTask
 * @package App\Grabber\Service\WebGuy\Task\DeviceSpecifications
 */
class BrandDevicesTask implements SpiderTaskInterface
{
    /**
     * @var string
     */
    private string $httpMethod;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var array
     */
    private array $requestData;

    /**
     * @var string
     */
    private string $handlerMethod;

    /**
     * @var WebGuyInterface|null
     */
    private ?WebGuyInterface $webGuy;

    /**
     * @param string $httpMethod
     * @param string $url
     * @param array $requestData
     * @param string $handlerMethod
     * @param WebGuyInterface|null $webGuy
     */
    public function __construct(
        string $httpMethod,
        string $url,
        array $requestData,
        string $handlerMethod,
        ?WebGuyInterface $webGuy = null
    ) {
        $this->httpMethod = $httpMethod;
        $this->url = $url;
        $this->requestData = $requestData;
        $this->handlerMethod = $handlerMethod;
        $this->webGuy = $webGuy;
    }

    /**
     * @inheritDoc
     */
    public function httpMethod() : string
    {
        return $this->httpMethod;
    }

    /**
     * @inheritDoc
     */
    public function url() : string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function requestData() : array
    {
        return $this->requestData;
    }

    /**
     * @inheritDoc
     */
    public function handlerMethod() : string
    {
        return $this->handlerMethod;
    }

    /**
     * @inheritDoc
     */
    public function webGuy() : ?WebGuyInterface
    {
        return $this->webGuy;
    }

    /**
     * @inheritDoc
     */
    public function delay() : int
    {
        return 10 * 1000000;
    }
}
