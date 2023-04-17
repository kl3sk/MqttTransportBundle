<?php

namespace Kl3sk\MqttTransportBundle\Mqtt;

interface MqttMessageInterface {
    public function getTopic(): string;

    public function getQos(): int;

    public function getBody(): string;
}