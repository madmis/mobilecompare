<?php

namespace App\Grabber\Service\WebGuy\Queue;

use App\Grabber\Service\WebGuy\SpiderTaskInterface;
use Generator;

/**
 * Interface QueueInterface
 * @package App\Grabber\Service\WebGuy\Queue
 */
interface QueueInterface
{
    /**
     * Returns and removes the value with the highest priority in the queue.
     *
     * @return SpiderTaskInterface
     */
    public function pop() : SpiderTaskInterface;

    /**
     * Pushes a value into the queue, with a specified priority.
     *
     * @param SpiderTaskInterface $task
     * @param int $priority
     */
    public function push(SpiderTaskInterface $task, int $priority) : void;

    /**
     * @return Generator
     */
    public function getIterator() : Generator;
}
