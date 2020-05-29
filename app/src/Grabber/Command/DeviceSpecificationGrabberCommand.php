<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Grabber\Command;

use App\Grabber\Service\WebGuy\Proxy\FatezeroProxyProvider;
use App\Grabber\Service\WebGuy\Proxy\ProxyChecker;
use App\Grabber\Service\WebGuy\Proxy\ProxyDtoInterface;
use App\Grabber\Service\WebGuy\Spider;
use App\Grabber\Service\WebGuy\WebGuy;
use App\Grabber\Service\WebGuy\WebScrapper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use JsonException;
use Psr\Cache\CacheItemInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Component\HttpClient\HttpClient;

/**
 * Class DeviceSpecificationGrabberCommand
 * @package App\Grabber\Command
 */
class DeviceSpecificationGrabberCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected static $defaultName = 'app:grab:ds';

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        parent::__construct();
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    protected function configure() : void
    {
        $this
            ->setDescription('https://www.devicespecifications.com/en Grabber')
            ->setHelp(<<<'EOT'
Grab:
    <info>php %command.full_name% /info>
EOT
            );
    }

    /**
     * {@inheritdoc}
     *
     * @param OutputInterface|ConsoleOutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) : int
    {
        $cache = new FilesystemAdapter();
        /** @var CacheItemInterface $proxiesList */
        $proxiesList = $cache->getItem('proxy.list');

        if (!$proxiesList->isHit()) {
            $proxies = (new FatezeroProxyProvider())->getProxies();
            $validProxies = (new ProxyChecker())->multiCheck($proxies);
            $proxiesList->set($validProxies)->expiresAfter(900);
            $cache->save($proxiesList);
        }

        $webGuy = new WebGuy([
            'http_version' => '1.1',
            //@formatter:off
            'proxy' => array_map(fn(ProxyDtoInterface $proxy) => "{$proxy->host()}:{$proxy->port()}", $proxiesList->get()),
            //@formatter:on
            'max_duration' => 15,
            'timeout' => 20,
            'verify_peer' => 1,
            'verify_host' => 0,
            'headers' => [
                'Accept-Encoding' => 'gzip, deflate, br',
                'User-Agent' => $this->getUserAgent(),
            ],
        ], $this->logger);
        $scrapper = new WebScrapper($webGuy, [], $this->logger);
        $scrapper->run(new Spider());

        return 0;
    }

    /**
     * @return string
     */
    public function getUserAgent() : string
    {
        $agents = [
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.2; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.90 Safari/537.36',
        ];

        return $agents[array_rand($agents)];
    }
}
