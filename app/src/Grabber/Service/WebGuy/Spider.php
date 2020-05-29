<?php

namespace App\Grabber\Service\WebGuy;

use App\Grabber\Service\WebGuy\Task\DeviceSpecifications\InitialTask;
use Ds\PriorityQueue;
use Generator;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Spider
 * @package App\Grabber\Service\WebGuy
 */
class Spider implements SpiderInterface
{
    /**
     * @var PriorityQueue
     */
    private PriorityQueue $queue;

    public function __construct()
    {
        $this->queue = new PriorityQueue();
        $this->queue->push(new InitialTask(), 1);
    }

    /**
     * @inheritDoc
     */
    public function tasks() : Generator
    {
        yield $this->queue->peek();
    }

    /**
     * @param SpiderTaskInterface $task
     * @param WebGuyInterface $webGuy
     *
     * @return void
     */
    public function brandMorePage(
        SpiderTaskInterface $task,
        WebGuyInterface $webGuy
    ) : void {
        $webGuy->crawler()->filterXPath('//div[@class="brand-listing-container-news"]/a')
            ->each(static function(Crawler $node) {
                // По идее нужны таблицы: data_provider - туда сохраняем информацию о сайтах с данными.
                // src_brand - названия брендов, возможные алиасы (json), теги (json)
                // device type - наверное пока можно хранить в коде
                // src_device - type, brand_id, model, aliases (json), tags  (json), release date, - https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/inheritance-mapping.html#class-table-inheritance
                // src_mobile_phone - наследуется от верхней. Хранит всю тех информацию о модели (тут подумать может еще дробить на разные таблицы)

                // TODO: сохраняем бренд.
                dump($node->attr('href'));
                dump($node->text());
            });
    }
}
