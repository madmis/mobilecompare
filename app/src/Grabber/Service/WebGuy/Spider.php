<?php

namespace App\Grabber\Service\WebGuy;

use App\Grabber\Service\WebGuy\Queue\InMemoryQueue;
use App\Grabber\Service\WebGuy\Queue\QueueInterface;
use App\Grabber\Service\WebGuy\Task\DeviceSpecifications\BrandDevicesTask;
use App\Grabber\Service\WebGuy\Task\DeviceSpecifications\InitialTask;
use Ds\PriorityQueue;
use Generator;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Spider
 * @package App\Grabber\Service\WebGuy
 */
class Spider implements SpiderInterface
{
    /**
     * @var QueueInterface
     */
    private QueueInterface $queue;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        LoggerInterface $logger = null
    ) {
        $this->queue = new InMemoryQueue();
        $this->queue->push(new InitialTask(), 1);
        $this->logger = $logger ?? new NullLogger();
    }

    /**
     * @inheritDoc
     */
    public function tasks() : Generator
    {
        return $this->queue->getIterator();
    }

    /**
     * @param SpiderTaskInterface $task
     * @param WebGuyInterface $webGuy
     *
     * @return void
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    public function brandMorePage(
        SpiderTaskInterface $task,
        WebGuyInterface $webGuy
    ) : void {
        $result = [];
        $dataFile = '/var/www/mobc/var/data/ds/brands.json';

        if (!$result) {
            $this->logger->debug('Parse "Brand More Page"');
            $webGuy->crawler()->filterXPath('//div[@class="brand-listing-container-news"]/a')
                ->each(function(Crawler $node, int $i) use (&$result, $webGuy) {
                    $url = trim($node->attr('href'));
                    $name = trim($node->text());
                    $result[] = ['name' => $name, 'url' => $url];
                    // По идее нужны таблицы: data_provider - туда сохраняем информацию о сайтах с данными.
                    // src_brand - названия брендов, возможные алиасы (json), теги (json)
                    // device type - наверное пока можно хранить в коде
                    // src_device - type, brand_id, model, aliases (json), tags  (json), release date, - https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/reference/inheritance-mapping.html#class-table-inheritance
                    // src_mobile_phone - наследуется от верхней. Хранит всю тех информацию о модели (тут подумать может еще дробить на разные таблицы)
                    $task = new BrandDevicesTask('GET', $url, [], 'brandDevices', $webGuy);
                    $this->queue->push($task, 2);
                });
        }

        if (count($result) > 0) {
            file_put_contents($dataFile, json_encode($result, JSON_THROW_ON_ERROR));
        }
    }

    /**
     * @param SpiderTaskInterface $task
     * @param WebGuyInterface $webGuy
     *
     * @return void
     */
    public function brandDevices(
        SpiderTaskInterface $task,
        WebGuyInterface $webGuy
    ) : void {
        $dataPath = '/var/www/mobc/var/data/ds/devices';
        $headerNodes = $webGuy->crawler()->filter('header.section-header');
        $modelsNodes = $webGuy->crawler()->filter('div.model-listing-container-80');
        $headerNodes->each(function(Crawler $node, int $i) use ($dataPath, $modelsNodes, $webGuy) {
            $result = [];
            if ($node->filter('h1')->count() === 1 && $modelsNodes->eq($i)->count() === 1) {
                $this->logger->debug('Header');
                $header = preg_replace('/\s/', '', $node->filter('h1')->text());
                [$brand, $year] = explode('-', $header);
                $this->logger->debug("{$brand} | {$year}");

                $this->logger->debug('Items');
                $result[$year] = [];

                $modelsNodes->eq($i)->filter('div[id^="model_"]')->each(
                    function(Crawler $modelNode) use (&$result, $year) {
                        $url = trim($modelNode->filter('a')->attr('href'));
                        $modelName = trim($modelNode->filter('h3')->text());
                        $this->logger->debug("\t{$modelName} | {$url}");
                        $result[$year] = ['model' => $modelName, 'url' => $url];

                        $this->logger->debug('--');
                    });
            }

            if ($result > 0 && !empty($brand)) {
                file_put_contents(
                    "{$dataPath}/{$brand}.json",
                    json_encode($result, JSON_THROW_ON_ERROR)
                );
            }

//                $node->filter("div.model-listing-container-80:nth-child({$i})")
//                    ->each(function(Crawler $modelNode) {
//                    dump($modelNode->text());
//                });

//                $node->filterXPath('/following-sibling::*[1]/div[@class="model-listing-container-80"]')
//                    ->each(function(Crawler $node) {
//                        dump($node);
//                        dump($node->html());
//                    });
        });
    }
}
