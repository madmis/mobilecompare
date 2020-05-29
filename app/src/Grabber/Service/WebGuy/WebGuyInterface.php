<?php

namespace App\Grabber\Service\WebGuy;

use GuzzleHttp\Exception\{BadResponseException, ConnectException, TooManyRedirectsException};
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Interface WebGuyInterface
 * @package App\Grabber\Service\WebGuy
 */
interface WebGuyInterface
{
    /**
     * @param string $method
     * @param string $url
     * @param array $requestData
     *
     * @return bool
     *
     * @throws ConnectException
     * @throws BadResponseException
     * @throws TooManyRedirectsException
     */
    public function go(string $method, string $url, array $requestData = []) : bool;

    /**
     * @return ResponseInterface
     */
    public function response() : ResponseInterface;

    /**
     * @return Crawler
     */
    public function crawler() : Crawler;
}
