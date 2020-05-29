<?php

namespace App\Grabber\Service\WebGuy\Task\DeviceSpecifications;

use App\Grabber\Service\WebGuy\SpiderTaskInterface;
use App\Grabber\Service\WebGuy\WebGuyInterface;

/**
 * Class InitialTask
 * @package App\Grabber\Service\WebGuy\Task\DeviceSpecifications
 */
class InitialTask implements SpiderTaskInterface
{
    /**
     * @inheritDoc
     */
    public function httpMethod() : string
    {
        return 'GET';
    }

    /**
     * @inheritDoc
     */
    public function url() : string
    {
        return 'https://www.devicespecifications.com/en/brand-more';
    }

    /**
     * @inheritDoc
     */
    public function requestData() : array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function handlerMethod() : string
    {
        return 'brandMorePage';
    }

    /**
     * @inheritDoc
     */
    public function webGuy() : ?WebGuyInterface
    {
        return null;
    }
}
