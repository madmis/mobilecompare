<?php

namespace App\Grabber\Service\WebGuy\Queue;

use App\Grabber\Service\WebGuy\SpiderTaskInterface;
use Ds\PriorityQueue;
use Generator;

/**
 * Class InMemoryQueue
 * @package App\Grabber\Service\WebGuy\Queue
 */
class InMemoryQueue implements QueueInterface
{
    /**
     * @var PriorityQueue
     */
    private PriorityQueue $queue;

    public function __construct()
    {
        $this->queue = new PriorityQueue();
    }

    /**
     * @inheritDoc
     */
    public function pop() : SpiderTaskInterface
    {
        return $this->queue->pop();
    }

    /**
     * @inheritDoc
     */
    public function push(SpiderTaskInterface $task, int $priority) : void
    {
        $this->queue->push($task, $priority);
    }

    /**
     * @inheritDoc
     */
    public function getIterator() : Generator
    {
        while (!$this->queue->isEmpty()) {
            yield $this->pop();
        }
    }
}
