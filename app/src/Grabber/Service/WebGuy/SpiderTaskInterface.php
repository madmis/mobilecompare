<?php

namespace App\Grabber\Service\WebGuy;

/**
 * Interface SpiderTaskInterface
 * @package App\Grabber\Service\WebGuy
 */
interface SpiderTaskInterface
{
    /**
     * @return string
     */
    public function httpMethod() : string;

    /**
     * @return string
     */
    public function url() : string;

    /**
     * @return array
     */
    public function requestData() : array;

    /**
     * @return string
     */
    public function handlerMethod() : string;
}
