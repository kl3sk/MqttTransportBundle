<?php


namespace Kl3sk\MqttTransportBundle\Mqtt;


use Monolog\Level;
use Monolog\Logger;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\ConfigurationInvalidException;
use PhpMqtt\Client\Exceptions\ConnectingToBrokerFailedException;
use PhpMqtt\Client\Exceptions\ProtocolNotSupportedException;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Repositories\MemoryRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Messenger\Transport\TransportFactoryInterface;
use Symfony\Component\Messenger\Transport\TransportInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MqttTransportFactory implements TransportFactoryInterface {

    private array $options;
    private bool $connected = false;
    /**
     * @var string[]
     */
    private array $topics;

    public function __construct(string                   $topics,
                                private readonly string  $clientId,
                                private readonly ?Logger $logger = null
    )
    {
        $this->topics = explode(',', $topics);
    }

    public function createTransport(string $dsn, array $options, SerializerInterface $serializer): TransportInterface
    {
        $parsedUrl = parse_url($dsn);

        if (false === $parsedUrl) {
            throw new \InvalidArgumentException(sprintf('The given MQTT DSN "%s" is invalid.', $dsn));
        }
        // dd($parsedUrl);

        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'host'      => 'localhost',
            'username'  => 'user',
            'password'  => 'password',
            'port'      => 1883,
            'client_id' => 'symfony_client_'.getmypid(),
        ]);

        $settings['host']      = $parsedUrl['host'];
        $settings['port']      = $parsedUrl['port'];
        $settings['username']  = $parsedUrl['user'];
        $settings['password']  = $parsedUrl['pass'];
        $settings['client_id'] = $this->clientId;


        $this->options = $resolver->resolve($settings);

        $this->logger?->log(Level::Info, 'Transport');

        return new MqttTransport($this->options, $this->topics, $serializer, $this->logger);
    }


    public function supports(string $dsn, array $options): bool
    {
        return str_starts_with($dsn, 'mqtt://');
    }
}