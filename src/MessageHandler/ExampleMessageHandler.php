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

    public function __construct(private readonly MailerInterface $mailer, private readonly ?LoggerInterface $logger = null) { }

    public function __invoke(ExampleMessage $message): void
    {

        $this->logger?->log(Level::Info, '--------------------------------');
        $this->logger?->log(Level::Info, '--------- Bundle Handled -------');
        $this->logger?->log(Level::Info, '--------------------------------');

        $content = $message->getContent(); //$json['content'];

        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Second Sample message')
            ->text($content)
            ->html("<p>Transport Message: {$content}</p>");

        $this->mailer->send($email);
    }
}
