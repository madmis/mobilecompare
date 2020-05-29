<?php

namespace App\Grabber\Service\WebGuy;

use GuzzleHttp\{Client,
    ClientInterface,
    Cookie\CookieJar,
    Exception\BadResponseException,
    Exception\ConnectException,
    Exception\RequestException,
    Exception\TooManyRedirectsException,
    Psr7\Response,
    RequestOptions
};
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebGuy
 * @package App\Grabber\Service\WebGuy
 */
class WebGuy implements WebGuyInterface
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var array
     */
    private array $proxy = [];

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @var Crawler
     */
    private Crawler $crawler;

    /**
     * @var LoggerInterface|NullLogger
     */
    private LoggerInterface $logger;

    /**
     * @param array $config
     * @param LoggerInterface|null $logger
     */
    public function __construct(array $config, ?LoggerInterface $logger = null)
    {
        if (!isset($config['cookies'])) {
            // Use a shared cookie session
            $config['cookies'] = new CookieJar();
        }

        if (isset($config['proxy'])) {
            $this->proxy = is_array($config['proxy'])
                ? array_values($config['proxy'])
                : [$config['proxy']];
        }

        $this->httpClient = new Client($config);
        $this->response = new Response();
        $this->crawler = new Crawler();
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @inheritDoc
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpFieldAssignmentTypeMismatchInspection
     */
    public function go(string $method, string $url, array $requestData = []) : bool
    {
        $options = [];
        if ($proxy = reset($this->proxy)) {
            $options['proxy'] = $proxy;
            $this->logger->info("Select proxy: {$proxy}");
        }

        strtoupper($method) === Request::METHOD_POST
            ? $options[RequestOptions::FORM_PARAMS] = $requestData
            : $options[RequestOptions::QUERY] = $requestData;

        try {
            $this->logger->info("Run request: {$method} {$url}", [
                'data' => $requestData,
            ]);
            $response = $this->httpClient->request($method, $url, $options);
        } catch (ConnectException $e) {
            // This might appear because of proxy unavailable, try to use another proxy
            $proxyKey = array_search($options['proxy'] ?? '', $this->proxy, false);
            unset($this->proxy[$proxyKey]);


            if (count($this->proxy) > 0) {
                $this->logger->warning("Proxy error: {$e->getMessage()}. This proxy removed, try new one");
                return $this->go($method, $url);
            }

            $this->logger->critical($e->getMessage());

            throw $e;
        } catch (BadResponseException $e) {
            if ($e->hasResponse()) {
                $this->response = $e->getResponse();
                $this->crawler = new Crawler((clone $this->response)->getBody()->getContents());
            }

            $this->logger->critical($e->getMessage());

            throw $e;
        } catch (TooManyRedirectsException $e) {
            if ($e->hasResponse()) {
                $this->response = $e->getResponse();
                $this->crawler = new Crawler((clone $this->response)->getBody()->getContents());
            }

            $this->logger->critical($e->getMessage());

            throw $e;
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->response = $e->getResponse();
                $this->crawler = new Crawler((clone $this->response)->getBody()->getContents());
            }

            // This might appear because of proxy unavailable, try to use another proxy
            $proxyKey = array_search($options['proxy'] ?? '', $this->proxy, false);
            unset($this->proxy[$proxyKey]);


            if (count($this->proxy) > 0) {
                $this->logger->warning("Proxy error: {$e->getMessage()}. This proxy removed, try new one");

                return $this->go($method, $url);
            }

            $this->logger->critical($e->getMessage());

            throw $e;

        }

        $this->logger->info("Request successful");
        $this->response = $response;
        $this->crawler = new Crawler((clone $this->response)->getBody()->getContents());

        return true;
    }

    /**
     * @inheritDoc
     */
    public function response() : ResponseInterface
    {
        return $this->response;
    }

    /**
     * @inheritDoc
     */
    public function crawler() : Crawler
    {
        return $this->crawler;
    }
}
