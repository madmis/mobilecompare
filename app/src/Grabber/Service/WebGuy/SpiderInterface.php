<?php

namespace App\Grabber\Service\WebGuy;

use Generator;

/**
 * Interface SpiderInterface
 * @package App\Grabber\Service\WebGuy
 */
interface SpiderInterface
{
    /**
     * @return Generator|SpiderTaskInterface
     */
    public function tasks() : Generator;

//    public function parse()
}
