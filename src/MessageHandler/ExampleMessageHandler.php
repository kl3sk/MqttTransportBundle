<?php

namespace Kl3sk\MqttTransportBundle\MessageHandler;

use Kl3sk\MqttTransportBundle\Message\ExampleMessage;
use Monolog\Level;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler(fromTransport: 'mqtt')]
final class ExampleMessageHandler {

    public function __construct(private readonly ?LoggerInterface $logger = null) { }

    public function __invoke(ExampleMessage $message): string
    {

        $this->logger?->log(Level::Info, '--------------------------------');
        $this->logger?->log(Level::Info, '--------- Bundle Handled -------');
        $this->logger?->log(Level::Info, '--------------------------------');

        return $message->getContent();
    }
}
