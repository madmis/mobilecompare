<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Grabber\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
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
        $httpClient = HttpClient::create();

        $output->writeln('');
        $proxy = $this->getProxy();
        dump($proxy);

        $done = false;

        //TODO: Создать WebGuy
        // WebGuy должен получать клиента как параметр, сам он не создает его.
        // И он оперирует всеми запросами только через этот client, не создавая нового.
        // PS: чисто для себя: можно сделать этот сервис отдельной библиотекой (open source и возможно еще продавать помощь)
        do {
            try {
                $response = $httpClient->request('GET', 'https://www.devicespecifications.com/en/brand-more', [
                    'http_version' => '1.1',
                    'proxy' => "{$proxy['host']}:{$proxy['port']}",
                    'max_duration' => 15,
                    'timeout' => 20,
                    'verify_peer' => 1,
                    'verify_host' => 0,
                    'headers' => [
                        'Accept-Encoding' => 'gzip, deflate, br',
                        'User-Agent' => $this->getUserAgent(),
                    ],
                ]);

                dump($response->getInfo('debug'));
                dump($response->getContent());
                dump($response->getHeaders());

                $crawler = new Crawler($response->getContent());
                $crawler->filter('.brand-listing-container-news a')->each(
                    function(Crawler $node) use ($output) {
                        dump($node->attr('href'));
                        dump($node->text());
                    }
                );
                $done = true;
            } catch (TransportException $e) {
                $output->writeln($e->getMessage());
            }
        } while ($done);

        return 0;
    }

    private array $proxies = [];

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

    /**
     * @return array
     * @noinspection PhpDocMissingThrowsInspection
     */
    private function getProxy() : array
    {
        if (!$this->proxies) {
            $proxiesRaw = file_get_contents('https://raw.githubusercontent.com/fate0/proxylist/master/proxy.list#');
            $this->proxies = explode("\n", $proxiesRaw);
        }

        return json_decode($this->proxies[array_rand($this->proxies)], true, 512, JSON_THROW_ON_ERROR);
    }


}
