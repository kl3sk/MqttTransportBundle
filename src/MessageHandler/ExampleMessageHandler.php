<?php

namespace Kl3sk\MqttTransportBundle\MessageHandler;

use Kl3sk\MqttTransportBundle\Mqtt\MqttMessage;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler(fromTransport: 'mqtt')]
final class ExampleMessageHandler {

    public function __construct(private readonly ?LoggerInterface $logger = null) { }

    public function __invoke(MqttMessage $message): string
    {
        /** Ex: Save in bdd
            $_message = new MqttMessage();
            $_message->setContent($message->getContent());
            $_message->setTopic($message->getTopic());
            $_message->setReceivedAt(new \DateTimeImmutable());

            $this->messageRepository->save($_message, true);
         */

        $this->logger?->log(Level::Info, '--------------------------------');
        $this->logger?->log(Level::Info, '--------- Bundle Handled -------');
        $this->logger?->log(Level::Info, '--------------------------------');

        return $message->getContent();
    }
}
