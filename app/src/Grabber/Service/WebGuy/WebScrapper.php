<?php

namespace App\Grabber\Service\WebGuy;

use BadMethodCallException;
use GuzzleHttp\Exception\{BadResponseException, ConnectException, TooManyRedirectsException};
use Psr\Log\{LoggerInterface, NullLogger};
use Throwable;

/**
 * Class WebScrapper
 * @package App\Grabber\Service\WebGuy
 */
class WebScrapper implements WebScrapperInterface
{
    /**
     * @var WebGuyInterface
     */
    private WebGuyInterface $webGuy;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var array
     */
    private array $options = [
        'skip_failed_requests' => true,
    ];

    /**
     * @param WebGuyInterface $webGuy
     * @param LoggerInterface $logger
     * @param array $options
     */
    public function __construct(
        WebGuyInterface $webGuy,
        array $options = [],
        ?LoggerInterface $logger = null
    ) {
        $this->webGuy = $webGuy;
        $this->options = array_merge($this->options, $options);
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @param SpiderInterface $spider
     *
     * @throws ConnectException
     * @throws BadResponseException
     * @throws TooManyRedirectsException
     * @throws BadMethodCallException
     * @noinspection PhpDocMissingThrowsInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function run(SpiderInterface $spider) : void
    {
        /** @var SpiderTaskInterface $task */
        foreach ($spider->tasks() as $task) {
            try {
                $this->webGuy->go($task->httpMethod(), $task->url(), $task->requestData());
            } catch (Throwable $e) {
                if ($this->options['skip_failed_requests']) {
                    $this->logger->info("Request was skipped because of: {$e->getMessage()}");
                    continue;
                }
                throw $e;
            }

            if (!method_exists($spider, $task->handlerMethod())) {
                throw new BadMethodCallException(
                    'Class "%s" does not implement method "%s"',
                    get_class($spider),
                    $task->handlerMethod()
                );
            }

            $spider->{$task->handlerMethod()}(
                $task,
                $this->webGuy->crawler(),
                $this->webGuy->response()
            );
        }
    }
}
