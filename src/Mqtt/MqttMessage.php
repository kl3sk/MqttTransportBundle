<?php

namespace Kl3sk\MqttTransportBundle\Mqtt;

class MqttMessage implements MqttMessageInterface {
    public function __construct(
        private readonly string $topic,
        private readonly string $content,
        private readonly int    $qos,
        private readonly bool   $retain
    )
    {
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function getQos(): int
    {
        return $this->qos;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getRetain(): string
    {
        return $this->retain;
    }
}