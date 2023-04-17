<?php

namespace Kl3sk\MqttTransportBundle\Message;

final class ExampleMessage {
    public function __construct(private readonly string $content)
    {
    }
    public function getContent(): string
    {
        return $this->content;
    }
}
