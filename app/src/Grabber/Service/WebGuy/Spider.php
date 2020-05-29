<?php

namespace App\Grabber\Service\WebGuy;

use Ds\PriorityQueue;
use Generator;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Spider
 * @package App\Grabber\Service\WebGuy
 */
class Spider implements SpiderInterface
{
    private string $startUrl;

    /**
     * @var PriorityQueue
     */
    private PriorityQueue $queue;

    /**
     * @inheritDoc
     */
    public function tasks() : Generator
    {
        yield $this->queue->peek();
    }

    /**
     * @return Generator|TaskInterface[]
     */
//    public function start() : Generator
//    {
////        $task = $this->createTask($url, $method);
//    }

//    public function parse(TaskInterface $task, Crawler $crawler, ResponseInterface $response) :
//    {
//        yield $task->parse()
//    }
//
//    private function createTask(string $url, string $method)

// спайдер запускает таски из очереди
// и шарит в каждую таску очередь (доступ к очереди)
// каждая таска может создавать новые такси и добавлять их в очередь.
// спайдер будет выполнять таски пока они есть в очереди
// в метод finalize (или как-то придумать метод после выполнения)
// передается response и crawler и в этом методе обрабатывается результат таски
}
